<script type="text/javascript">  
   /**
     *  History of commands.
     */
    (function ($) {
        var maxHistory = 100;
        var position = -1;
        var currentCommand = '';
        var addCommand = function (command) {
            var ls = localStorage['commands'];
            var commands = ls ? JSON.parse(ls) : [];
            if (commands.length > maxHistory) {
                commands.shift();
            }
            commands.push(command);
            localStorage['commands'] = JSON.stringify(commands);
        };
        var getCommand = function (at) {
            var ls = localStorage['commands'];
            var commands = ls ? JSON.parse(ls) : [];
            if (at < 0) {
                position = at = -1;
                return currentCommand;
            }
            if (at >= commands.length) {
                position = at = commands.length - 1;
            }
            return commands[commands.length - at - 1];
        };

        $.fn.history = function () {
            var input = $(this);
            input.keydown(function (e) {
                var code = (e.keyCode ? e.keyCode : e.which);

                if (code == 38) { // Up
                    if (position == -1) {
                        currentCommand = input.val();
                    }
                    input.val(getCommand(++position));
                    return false;
                } else if (code == 40) { // Down
                    input.val(getCommand(--position));
                    return false;
                } else {
                    position = -1;
                }
            });

            return input;
        };

        $.fn.addHistory = function (command) {
            addCommand(command);
        };
    })(jQuery);

    /**
     * Autocomplete input.
     */
    (function ($) {
        $.fn.autocomplete = function (suggest) {
            // Wrap and extra html to input.
            var input = $(this);
            input.wrap('<span class="autocomplete" style="position: relative;"></span>');
            var html =
                '<span class="overflow" style="position: absolute; z-index: -10;">' +
                    '<span class="repeat" style="opacity: 0;"></span>' +
                    '<span class="guess"></span></span>';
            $('.autocomplete').prepend(html);

            // Search of input changes.
            var repeat = $('.repeat');
            var guess = $('.guess');
            var search = function (command) {
                var array = [];
                for (var key in suggest) {
                    if (!suggest.hasOwnProperty(key))
                        continue;
                    var pattern = new RegExp(key);
                    if (command.match(pattern)) {
                        array = suggest[key];
                    }
                }

                var text = command.split(' ').pop();

                var found = '';
                if (text != '') {
                    for (var i = 0; i < array.length; i++) {
                        var value = array[i];
                        if (value.length > text.length &&
                            value.substring(0, text.length) == text) {
                            found = value.substring(text.length, value.length);
                            break;
                        }
                    }
                }
                guess.text(found);
            };
            var update = function () {
                var command = input.val();
                repeat.text(command);
                search(command);
            };
            input.change(update);
            input.keyup(update);
            input.keypress(update);
            input.keydown(update);

            input.keydown(function (e) {
                var code = (e.keyCode ? e.keyCode : e.which);
                if (code == 9) {
                    var val = input.val();
                    input.val(val + guess.text());
                    return false;
                }
            });

            return input;
        };
    })(jQuery);

    /**
     * Windows variables.
     */
    window.currentDir = '<?php echo "???" ?>';
    window.currentDirName = window.currentDir.split('/').pop();
    window.currentUser = '<?php echo "Hero" ?>';
    window.titlePattern = "* — console";
    window.document.title = window.titlePattern.replace('*', window.currentDirName);
    
    /**
     * Init console.
     */
    $(function () {
        var screen = $('pre');
        var input = $('input').focus();
        var form = $('form');
        var scroll = function () {
            window.scrollTo(0, document.body.scrollHeight);
        };
        input.history();
        input.autocomplete(<?php echo json_encode($autocomplete); ?>);
        
        //Routinely request for messages to the screen and then 
        
        
        function runCmd(command){
            var socket = io.connect('http://mysterychat-jelec.c9.io/');
            socket.emit('identify', 'System');
            socket.emit('message', command);
            
            socket.on('connect', function () {
                socket.emit('identify', 'hero');
            });
            
            $.get('', {'command': command, 'cd': window.currentDir}, function (output) {
                var pattern = /^set current directory (.+?)$/i;
                if (matches = output.match(pattern)) {
                    window.currentDir = matches[1];
                    window.currentDirName = window.currentDir.split('/').pop();
                    $('#currentDirName').text(window.currentDirName);
                    window.document.title = window.titlePattern.replace('*', window.currentDirName);
                } else {
                    screen.append(output);
                }
            })
                .fail(function () {
                    screen.append("<span class='error'>Command is sent, but due to an HTTP error result is not known.</span>\n");
                })
                .always(function () {
                    form.show();
                    scroll();
                });
            return false;
        }
        
        form.submit(function () {
            var command = $.trim(input.val());
            if (command == '') {
                return false;
            }

            // $("<code>" + window.currentDirName + "&nbsp;" + window.currentUser + "$&nbsp;" + command + "</code><br>").appendTo(screen);
            scroll();
            input.val('');
            form.hide();
            input.addHistory(command);
            socket.emit('message', command);
            $.get('', {'command': command, 'cd': window.currentDir}, function (output) {
                var pattern = /^set current directory (.+?)$/i;
                if (matches = output.match(pattern)) {
                    window.currentDir = matches[1];
                    window.currentDirName = window.currentDir.split('/').pop();
                    $('#currentDirName').text(window.currentDirName);
                    window.document.title = window.titlePattern.replace('*', window.currentDirName);
                } else {
                    screen.append(output);
                }
            })
                .fail(function () {
                    screen.append("<span class='error'>Command is sent, but due to an HTTP error result is not known.</span>\n");
                })
                .always(function () {
                    form.show();
                    scroll();
                });
            return false;
        });
        
        // Initialization Commands
        runCmd("start");
        

        $(document).keydown(function () {
            input.focus();
        });
    });
</script>
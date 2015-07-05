<?php if ($theme == "ubuntu") { ?>
    <style type="text/css">
        body {
            color: #FFFFFF;
            background-color: #281022;
        }

        code {
            color: #898989;
        }

        .diff-header {
            color: #FFF;
        }
    </style>
<?php } elseif ($theme == "grey") { ?>
    <style type="text/css">
        body {
            color: #B8B8B8;
            background-color: #424242;
            font-family: Monaco, Courier, monospace;
        }

        code {
            color: #FFFFFF;
        }

        form, input {
            color: #FFFFFF;
        }

        .diff-header {
            color: #B8B8B8;
        }

        .diff-sub-header {
            color: #cbcbcb;
        }
    </style>
<?php } elseif ($theme == "far") { ?>
    <style type="text/css">
        body {
            color: #CCCCCC;
            background-color: #001F7C;
            font-family: Terminal, monospace;
        }

        code {
            color: #6CF7FC;
        }

        .diff-header {
            color: aqua;
        }

        .diff-sub-header {
            color: #1f7184;
        }
    </style>
<?php } elseif ($theme == "white") { ?>
    <style type="text/css">
        body {
            color: #FFFFFF;
            background-color: #000000;
            font-family: monospace;
        }

        code {
            color: #898989;
        }

        .diff-header {
            color: #FFF;
        }
    </style>
<?php } elseif ($theme == "green") { ?>
    <style type="text/css">
        body {
            background-color: #000000;
            color: #00C000;
            font-family: monospace;
        }

        code {
            color: #00C000;
        }

        .diff-added {
            color: #23be8c;
        }
    </style>
<?php } ?>
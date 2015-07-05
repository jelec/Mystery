#!/bin/python
# Door implementation 
import sys
import json
from pprint import pprint
import shutil
import subprocess

# shutil.copyfile("origin.json", sys.argv[1] + ".json")

# User data saving and routing
with open( "origin.json", 'a+') as data_file:    
    data = json.load(data_file)

# State changing here
if data["state"] == "0": 
    data["state"] = "1c"
    with open( "../creation_files/creation_1", 'a+') as data_file:    
        datax = data_file.read()
    print datax
elif data["state"] == "1c":
    data["state"] = "2c"
    with open( "../creation_files/creation_2", 'a+') as data_file:    
        datax = data_file.read()
    print datax
elif data["state"] == "2c": 
    data["state"] = "3c"
    with open( "../creation_files/creation_3", 'a+') as data_file:    
        datax = data_file.read()
    print datax
elif data["state"] == "3c": 
    data["state"] = "1"
    with open( "../creation_files/creation_4", 'a+') as data_file:    
        datax = data_file.read()
    print datax
elif data["state"] == "1":
    data["state"] = "2"
    with open( "../story_files/story_1", 'a+') as data_file:    
        datax = data_file.read()
    print datax
elif data["state"] == "2":
    with open( "../story_files/story_2", 'a+') as data_file:    
        datax = data_file.read()
    print datax
    
with open('origin.json', 'w') as outfile:
    json.dump(data, outfile)
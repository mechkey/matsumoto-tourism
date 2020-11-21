#!/bin/bash

read -r -p "Which directory do you want to load: [a/l] " input

if [ -d "/Applications/MAMP/htdocs" ];
then 
	rm /Applications/MAMP/htdocs
fi

if [[ "$input" == "a" ]] ; then
	ln -s ~/Desktop/html5/tourism /Applications/MAMP/htdocs && echo "Tourism assessment folder symlinked to MAMP" 
elif [[ "$input" == "l" ]] ; then
	ln -s ~/Desktop/html5/lab /Applications/MAMP/htdocs && echo "Lab folder symlinked to MAMP"
else 
	echo "Error symlinking folder"
fi
open -a Safari http://localhost/phpMyAdmin/
echo "Opening phpMyAdmin in Safari . . ."

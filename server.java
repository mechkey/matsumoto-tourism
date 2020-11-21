

ProcessBuilder pb = new ProcessBuilder("ls");
pb.inheritIO();
pb.command("bash", "-c", "rm /Applications/MAMP/htdocs");

pb.command("bash", "-c", "ln -s ~/Desktop/html5/lab8 /Applications/MAMP/htdocs");

pb.start();





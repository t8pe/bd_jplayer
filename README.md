bd_jplayer
==========

jPlayer plugin for WordPress 

So far, this is not at all elegant. It's a work in progress. I'm trying to get basic jPlayer functionality to work nicely in WordPress - there are other plugins that offer some of the same functionality (mp3-jplayer, for example) but they tend to be heavily customized and also tend to lack core support (for example, not handling ogg files). 
This runs! But there are errors, and uglinesses. And the licensing is almost certainly slightly incorrect - as I have to go back and check on the license that jPlayer uses.

This draws from jPlayer.org, which is a great project.

NOTES:
------

1. The Playlists read from a Custom Field called "songlist" which is simply a comma-separated list of the page IDs of the Songs to be included. For example, if you had a Song with post=14 and another with post=132, the songlist would read 14,132 - simple as that. 
2. Yes, the single-playlist.php template is hideous. I'm working on that.

B.

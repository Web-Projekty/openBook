POST
	->postID <int>
	->userID <int>
	->postName <varchar(64)>
USER
	->userID <int>
	->userName <varchar(16)>
REACTION
	->postID <int>
	->userID <int>
	->liked <boolean>
	->coment <varchar(256)>
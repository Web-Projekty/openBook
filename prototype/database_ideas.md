POST
	->postID <int>
	->userID <int>
	->postName <varchar(64)>
	->date <date>
USER
	->userID <int>
	->userName <varchar(16)>
	->userImgID <int>
REACTION
	->postID <int>
	->userID <int>
	->liked <boolean>
	->coment <varchar(256)>
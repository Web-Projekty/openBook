POST
	->postID <int>
	->userID <int>
	->postName <varchar(64)>
	->date <date>
USER
	->userID <int>
	->userName <varchar(16)>
	->userImgID <int>
	->password <varchar(hash_format.length)>
REACTION
	->postID <int>
	->userID <int>
	->liked <boolean>
	->coment <varchar(256)>
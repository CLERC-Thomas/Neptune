<?php
if(isLogged()){
	session_destroy();
}
header("Location: ?");
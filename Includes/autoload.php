<?php
function autoload($classname)
{
  if (file_exists($file = 'C:\wamp64\www\blogv2\Controllers\\' . $classname . '.php'))
  {
    require $file;
  }
  elseif (file_exists($file = 'C:\wamp64\www\blogv2\Models\\' . $classname . '.php')) 
  {
  	require $file;
  }
  elseif (file_exists($file = 'C:\wamp64\www\blogv2\Entities\\' . $classname . '.php')) 
  {
  	require $file;
  }
   elseif (file_exists($file = 'C:\wamp64\www\blogv2\Includes\\' . $classname . '.php')) 
  {
  	require $file;
  }
  else
  {
  	echo "Classe introuvale, impossible de l'inclure ";
  }


  
}

spl_autoload_register('autoload');
?>
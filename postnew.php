<?php
try {
    if (empty($field)) {
      throw new Exception("The field is undefined."); 
    }
    // rest of code here...
  }
  catch (Exception $e) {
    /*
        Here you can either echo the exception message like: 
        echo $e->getMessage(); 

        Or you can throw the Exception Object $e like:
        throw $e;
    */
  }
  ?>
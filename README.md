# Simple MVC structure

index.php requires init.php witch requires App.php and Controller.php;

then it instantiates an object of type App;

## App.php

App.php is a class with 3 parameters: 
- controller
- method
- params

When an instance of App is created it will parse the URL structured like this:

https://.../controller/method/param1/param2/...

It creates dynamically the controller passed in the URL storing it in his private field as well as the methods and an array of parameters.
- If no controller was was it will use the default one ('Home' in this case);
- If no method was passed if will use the default one ('index' in this case).

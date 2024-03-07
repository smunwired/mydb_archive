<!DOCTYPE html>
<html lang = "en">
    <head>
            <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>
            <script type="text/javascript" src="timeline.js"></script>
<!--            <link rel="stylesheet" href="master.css" type="text/css" media="screen" />	-->
<style>
#cTask {
    background-color:lightgreen;
}
#button {
    position:relative;
    float:right;
}
#addEventForm {
    position:relative;
    float:right;
    #margin:auto;
    border: 2px solid #003B62;
    font-family: verdana;
    background-color: #B5CFE0;
    padding-left: 10px;
}
</style>
</head>
    <body bgcolor="000" TEXT="FFFFFF">
            <div id="button">
                    <button onclick="showForm()" type="button" id="cTask">
                    Create Task
                    </button>
            </div>
            <div id="addEventForm">
                    <form>
                            <p><label>Customer name: <input></label></p>
                            <p><label>Telephone: <input type=tel></label></p>
                            <p><label>E-mail address: <input type=email></label></p>
                    </form>
            </div>
            <div>
                    <canvas id="myBoard" width="1000" height="600">
                            <p>Your browser doesn't support canvas.</p>
                    </canvas>
            </div>
    </body>
</html>

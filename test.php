<!DOCTYPE html>
<html>
<body>

<p>Click the button to demonstrate the prompt box.</p>

<button onclick="myFunction()">Try it</button>

<p id="demo"></p>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js">
function myFunction() {
    var person = prompt("hello\nPlease enter your name", "Harry Potter");
    if (person != null) {
        $.ajax({
        data: 'orderid=' + demo,
        url: 'ab.php',
        method: 'POST', // or GET
        success: function(msg) {
            alert(msg);
        }
    });
    }
}
</script>

</body>
</html>


function showHint(str) {
    if (str.length == 0) { 
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "gethint.php?q=" + str, true);
        xmlhttp.send();
    }
}
function showComments(pid) {
	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("comm").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "getComments.php?q=" + pid, true);
    xmlhttp.send();
}
function addComment(pid,co) {
	var comment = document.getElementsByName(co)[0].value;
	console.log(comment);
	console.log(pid);
	var t = new XMLHttpRequest();
	t.onreadystatechange = function() {
		if(t.readyState == 4 && t.status == 200) {
			document.getElementById("abcd").innerHTML = t.responseText;
		}
	}
	t.open("GET", "addCommentScript.php?q="+pid+"&r="+comment,true);
	t.send();	
}
function abc() {
	var t = new XMLHttpRequest();
	t.onreadystatechange = function() {
		if(t.readyState == 4 && t.status == 200) {
			document.getElementById("loginSpace").innerHTML = t.responseText;
		}
	}
	t.open("GET", "logout.php" ,true);
	t.send();	
	alert("Logged Out!");
}
function addRating(pid) {
	// var rat = document.getElementsByName('name')[0].value;
	var rat = prompt("Enter rating(1-10):");
	if(!rat) return;
	if(!(rat>=1 && rat<=10)) {
		alert("Rating should be between 1 and 10");
	}
	else {
		var t = new XMLHttpRequest();
		t.onreadystatechange = function() {
			if(t.readyState == 4 && t.status == 200) {
				alert(t.responseText);
			}
		}
		t.open("GET", "addRatingScript.php?q="+rat+"&r="+pid,true);
		t.send();
	}
}
function addToBasket(pid) {
	var q = prompt("Specify quantity:");
	if(!q) return;
	if(q<=0) {
		console.log("$q");
		alert("Invalid entry!");
	}
	else {
		var t = new XMLHttpRequest();
		t.onreadystatechange = function() {
			if(t.readyState == 4 && t.status == 200) {
				alert(t.responseText);
			}
		}
		t.open("GET", "addToBasketScript.php?q="+pid+"&r="+q,true);
		t.send();
	}
}
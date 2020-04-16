var time = Date.now();
var shapeDiv = document.getElementById("shape");




document.getElementById("shape").onclick = function() {
	
	var timeTaken = (Date.now() - time) / 1000;
	document.getElementById("time").innerHTML = "Your time:" + timeTaken + " seconds";
	shapeDiv.style.backgroundColor = "white";
	
	setTimeout(function() {
	
		var x = Math.random() * 600;
		var y = Math.random() * 600;
		
		shapeDiv.style.top = x + "px";
		shapeDiv.style.left = y + "px";
		
		var colours = ["red", "green", "blue", "yellow"];
		
		shapeDiv.style.backgroundColor = colours[Math.floor(Math.random() * colours.length)];
		
		if (Math.random() < 0.5) {
			
			shapeDiv.style.borderRadius = "50%";
		
		} else {
		
			shapeDiv.style.borderRadius = "0%";
		}
		
		time = Date.now();
		
	
	}, 1000);
	

};
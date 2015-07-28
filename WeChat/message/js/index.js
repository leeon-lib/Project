
function getEleByClass(classname){
	var tags = document.getElementsByTagName('*');
	var arr = [];
	for (var i = 0; i < tags.length; i++) {
		if(tags[i].className == classname){
			arr.push(tags[i]);
		}
	};
	return arr;
}

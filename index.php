<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  crossorigin="anonymous"></script>

<div class="definition"></div>
<form class="word" > <input class="desire" type="text" name="word"> </form>
<div class="counter"> 0 </div>

<script type="text/javascript">
	$(".word").submit(function(e) {
		e.preventDefault()
		console.log($(".desire").val())
		getdefinition($(".desire").val())
		$(".counter").text(0)
	})
	$(".definition").on("click", ".single-word", function(e){
		console.log($(this).text())
		getdefinition($(this).text())
		var counter = $(".counter").text()
		counter++
		$(".counter").text(counter)
	})
	
function getdefinition(word) {
	console.log(word)
	$.get( "https://www.dictionaryapi.com/api/v3/references/collegiate/json/"+word+"?key=7aad9438-0486-4652-9fa3-c3cf48138d86", function( data ) {
		var i=1
		$(".definition").html("")
		data.forEach(function(element) {
			// console.log(element.shortdef[0])
			var shortdef = element.shortdef[0]
			var words = shortdef.split(' ')
			$(".definition").append(i+". ("+element.hwi.hw+") ")
			
			words.forEach(function(word){
				// console.log(word)
				$(".definition").append('<span class="single-word">' + word + '</span>' +" ")
			})
			$(".definition").append("<br>")
			i++
		})
  			
  			

	});
}
</script>
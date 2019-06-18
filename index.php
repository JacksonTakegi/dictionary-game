<script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        crossorigin="anonymous"></script>
<style type="text/css">
    .single-word:hover {
        font-weight: 800;
        cursor: pointer;
    }

    body {
        text-align: center
    }

    .container {
        width: 80%;
        text-align: left;
        display: inline-block;
        background-color: #eee;
        border: 2px solid blue;
        border-radius: 5px;
        padding: 20px 22px 24px 26px;
        min-height: 100px;
        margin-top: 20px;
        font-family: sans-serif;
        line-height: 25px;
        box-shadow: 37px 30px 34px cornflowerblue;
    }
</style>

<div class="container">
    <h1 class="current-word"></h1>
    <div class="definition"></div>
    <form class="word"><input class="desire" type="text" name="word"></form>
    <div>Words Clicked: <span class="counter">0</span></div>
    <div class="breadcrumbs">start</div>
</div>

<script type="text/javascript">
    $(".word").submit(function (e) {
        e.preventDefault()
        console.log($(".desire").val())
        getdefinition($(".desire").val())
        $(".counter").text(0)
        $(".breadcrumbs").text("start")
    })
    $(".definition").on("click", ".single-word", function (e) {
        var word = $(this).text().replace(/\W/g, '')
        console.log(word)
        getdefinition(word)
        var counter = $(".counter").text()
        counter++
        $(".counter").text(counter)
    })

    function getdefinition(word) {
        console.log(word)
        $.get("https://www.dictionaryapi.com/api/v3/references/collegiate/json/" + word + "?key=7aad9438-0486-4652-9fa3-c3cf48138d86", function (data) {
            $(".breadcrumbs").append("->"+word)
            $(".current-word").text(word)
            var i = 1
            $(".definition").html("")
            data.forEach(function (element) {
                // console.log(element.shortdef[0])
                var shortdef = element.shortdef[0]
                var words = shortdef.split(' ')
                $(".definition").append(i + ". (" + element.hwi.hw + ") ")

                words.forEach(function (word) {
                    // console.log(word)
                    $(".definition").append('<span class="single-word">' + word + '</span>' + " ")
                })
                $(".definition").append("<br>")
                i++


            })


        });
    }
</script>
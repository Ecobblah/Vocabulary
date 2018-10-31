<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta property="og:url"           content="http://emmanuelcobbtesthostingpackage-com.stackstaging.com/vocab/" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="Search definitions!" />
    <meta property="og:description"   content="Fetches your definitions without reloading the page" />
    <meta property="og:image"         content="https://www.your-domain.com/path/image.jpg" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">

    <title>Vocab</title>
  </head>
  <body>
      <h2>Word of the day!</h2>
      <span id="newWord"></span>
      <span id="wordOfDay"></span>

    <form class="" action="" method="post">
        <input id="input"type="text" name="word" value="">
        <input id="search"type="button" name="" value="Search">
        <div id="output">

        </div>
      </form>
      <input id="download"type="button" name="" value="Download words">
<!---
      <div id="fb-root"></div>
      <div class="fb-share-button"
    data-href="http://emmanuelcobbtesthostingpackage-com.stackstaging.com/vocab/"
    data-size="large"
    data-layout="button">
  </div>

  <iframe src="https://www.facebook.com/plugins/share_button.php?href=http://emmanuelcobbtesthostingpackage-com.stackstaging.com/vocab/&layout=button&size=large&mobile_iframe=true&width=73&height=28&appId" width="73" height="28" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
-->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
    <script type="text/JavaScript" src="jspdf.min.js"></script>
    <script>
        var key = "92175cfc532f814ba060408916a0e492075768c5fb262baba";
        var def;
        var sentence;
        var word;
        var Url;

        wordOfDay();

      $(document).ready(function(){


            $("#search").click(function(){
              console.log($("#output").text());
              word = $("#input").val().toLowerCase();
              $("#input").val("");
              Url = "https://api.wordnik.com/v4/word.json/"+word+"/definitions?limit=200&includeRelated=false&useCanonical=false&includeTags=false&api_key="+key;
              console.log("PRINT: "+$("#input").val());
              $.ajax({
                url: Url,
                dataType: 'json',
                success: function(result){
                  def = result[0].text;
                  console.log(def);
                  console.log(result);
                  $("#output").append("<p>"+"<strong>"+word+"</strong>"+": "+def+"</p>");
                }
              });

            });

            $("#input").keypress(function(e) {
              if(e.which == 13){
                word = $("#input").val().toLowerCase();
                $("#input").val("");
                Url = "https://api.wordnik.com/v4/word.json/"+word+"/definitions?limit=200&includeRelated=false&useCanonical=false&includeTags=false&api_key="+key;
                $.ajax({
                  url: Url,
                  dataType: 'json',
                  success: function(result){
                    def = result[0].text;
                    console.log(def);
                    console.log(result);
                    $("#output").append("<p>"+"<strong>"+word+"</strong>"+": "+def+"</p>");
                  }
                });
              }
            });


      });

      function wordOfDay(){
        $.ajax({
          url:   "https://api.wordnik.com/v4/words.json/wordOfTheDay?api_key="+key,
          dataType: 'json',
          success: function(result){
            word = result.word;
            console.log("Word of the day: "+word);
            def = result.definitions[0].text;
            $("#newWord").html("<strong>"+word+"</strong>"+"</br>");
            $("#wordOfDay").html("<p><em>"+def+"</em></p>");
          }
        });
      }
      /*$("#getWords").click(function(){
        $("strong").each(function( index ){
          $("#output").html( index+$(this).text()+" " );
        })
      });

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
      */
      $("#download").click(function(){
        console.log($("#output").text());
        var pdfInfo = $("#output").text();
        //pdfInfo = pdfInfo.replace(/\./g,'.'+'\n');
        var doc = new jsPDF();
        doc.setFontSize(28)
        doc.text(75, 15, 'Vocab words!');
        doc.setFontSize(9);
        //pdfInfo = doc.splitTextToSize(pdfInfo, 180)
        //doc.text(20, 30, pdfInfo);
    //  var test = doc.splitTextToSize(reportTitle, 180);
        var specialElementHandlers = {
         '#editor': function(element, renderer){
          return true;
         }
        };
        doc.fromHTML($('#output').get(0), 15, 15, {
         'width': 170,
         'elementHandlers': specialElementHandlers
        });
      //  doc.fromHTML($("#output").get(0, 20,20,{ 'width': 500}));
        doc.setProperties({
         title: 'Vocabulary',
         subject: 'List of Definitions',
         author: 'Emmanuel Cobblah',
         keywords: 'generated, javascript, web 2.0, ajax',
         creator: 'Emmanuel Cobblah'
        });

        doc.save('test.pdf');
      });


      $(function() {
        $("form").submit(function() { return false; });
      });
    </script>
  </body>
</html>

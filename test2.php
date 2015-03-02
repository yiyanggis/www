<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="http://d3js.org/d3.v3.min.js"></script>
	<script type="text/javascript">
		//https://maps.googleapis.com/maps/api/geocode/json?address=xinyu,+china&sensor=false&key=AIzaSyCp1HWib0Es6rZGsfylHOZMawOiOZYx3Q4

    //console.log("test");

    //$("#btn").text("test");

    var csvData;

    var apiKey="AIzaSyCp1HWib0Es6rZGsfylHOZMawOiOZYx3Q4";

    $(document).ready(function(){
      console.log("test");

      var progressOutput=$("#progress");

      $.ajax({
              url:"https://maps.googleapis.com/maps/api/geocode/json?address=xinyu,+china&sensor=false&key="+apiKey,
            }).done(function(d){
              console.log(d);
              d.results[0].geometry.lng
              d.results[0].geometry.lat
            });

      d3.csv("../data/invest307.csv",function(data){
        //console.log(data);
        csvData=data;

        //for(var i=0;i<5;i++){
        $.each(csvData,function(index,value){
          if(value.City_1===""){
            console.log("info missing");

            value.X=0;
            value.Y=0;
          }
          else{
            //console.log(data[i].City_1+","+data[i].Country_1);
            if(value.State!=""){
              $.ajax({
                url:"https://maps.googleapis.com/maps/api/geocode/json?address="+value.City_1+",+"+value.State+",+"+value.Country_1+"&sensor=false&key="+apiKey,
                async:false
              }).done(function(d){
                if(d.status=="OK")//ZERO_RESULTS
                {
                  console.log(d);
                  value.X=d.results[0].geometry.location.lng;
                  value.Y=d.results[0].geometry.location.lat;
                }
              });
            }
            else{
              $.ajax({
                url:"https://maps.googleapis.com/maps/api/geocode/json?address="+value.City_1+",+"+value.Country_1+"&sensor=false&key="+apiKey,
                async:false
              }).done(function(d){
                if(d.status=="OK")//ZERO_RESULTS
                {
                  console.log(d);
                  value.X=d.results[0].geometry.location.lng;
                  value.Y=d.results[0].geometry.location.lat;
                }
              });
            }
            
          }

          $(progressOutput).val(index);
          
        });

        //setTimeout(function(){},100000);

        var csvContent="data:text/csv;charset=utf-8,";

          $.each(csvData,function(index,value){
            csvContent+=index+","+value.X+","+value.Y+","+value.City_1+","+value.Country_1+","+"\n";

          });

          var encodeUri=encodeURI(csvContent);
          window.open(encodeUri);

      });

      /*$.ajax({
        url:"https://maps.googleapis.com/maps/api/geocode/json?address=xinyu,+china&sensor=false&key=AIzaSyCp1HWib0Es6rZGsfylHOZMawOiOZYx3Q4",
      }).done(function(data){
        console.log(data);
      });*/
    });

	
	</script>

</head>
<body>
    <input id="btn" type="button" value="search for miami coordinates" />
    <input id="progress" type="text">
</body>
</html>
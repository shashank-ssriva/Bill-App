<html>

    <head>

       <title> Cab Bills </title>
 <link rel="stylesheet" type="text/css" media="all" href="/jsdate/jsDatePick_ltr.min.css" />
	 <script type="text/javascript" src="/jsdate/jsDatePick.min.1.3.js"></script>

       <script language="javascript">
      function f(){
		new JsDatePick({
			useMode:2,
			target:"dateval",
			dateFormat:"%Y/%m/%d"
				});
	}

        function checkDt(thefield){
			//alert("checking date");

         var dt=thefield.value;
         d=dt.substring(8,10);
         m=dt.substring(5,7);
         y=dt.substring(0,4);
		//alert(""+d+m+y);
		sep1=dt.substring(4,5);
        sep2=dt.substring(7,8);
        if(sep1!='/' || sep2!='/')
		   {
			          //  alert("sep");
                                      return false;

                                    }
        else if(d<1 || d>31 || m<1 || m>12|| y<1950 || y>2017)
                                   {
                                      return false;

                                    }

         else if((m==4 || m==6 || m==9 || m==11) && d>30)
                                         {
                                          return false;

                                          }

                 else if(m==2)
                                       {

                                             if(y%4==0 && !(y%400!=0  && y%100==100) )
                                                 {
                                                    if(d>29)
                                                    return false;
                                                 }
                                               else if(d>28)

                                                 return false;
                                           }

                    return true;
        }

          function isEmpty(thefield)

                    {

                     if(thefield.value=="")
                            { return true;}

                      else
                            return false;
                  }
          function isAlpha(thefield)
               {
              var v=thefield.value;
              l=v.length;
              for(i=0;i<l;i++)
               {
                  c=v.substring(i,i+1);
                 if(!(c>='A' && c<='Z' || c>='a' && c<='z' || c==' '))
                 {
               thefield.focus();
               return false;
              }
            }
            return true;
          }


          function isnumeric(thefield)
                   {
                        s=thefield.value;
                        l=s.length;
                        for(i=0;i<l;i++)
                         {v=s.substring(i,i+1);

                           if(!(v>="0" && v<="9"))

                              return false;
                          }

                      return true;
                    }

          function isAmount(thefield)
                   {
                        s=thefield.value;
                        l=s.length;
                        for(i=0;i<l;i++)
                         {v=s.substring(i,i+1);

                           if(!((v>="0" && v<="9")|| v=="."))

                              return false;
                          }

                      return true;
                    }


         function f1(){
			 if(isEmpty(document.myForm.dateval))
                           {

                            alert("Date Field can't be left empty");
                            document.myForm.dateval.focus();
                            }
					  else if(!checkDt(document.myForm.dateval))
                               {

                                alert("Date  :  Invalid ");
                                document.myForm.dateval.focus();
                               }
			 else if (isEmpty(document.myForm.amt1)){
                  alert("Amount : Empty field");
				  document.myForm.amt1.focus();
                }
                else if (isEmpty(document.myForm.amt2)){
                  alert("  Amount: Empty field");
                 document.myForm.amt2.focus();
				 }

                   else if (!isAmount(document.myForm.amt1)){
                       alert("Amount: Non-numeric");
                        document.myForm.amt1.focus();
						}
				    else if (!isAmount(document.myForm.amt2)){
                       alert("Amount: Non-numeric");
                        document.myForm.amt2.focus();
						}
					 else{

                            document.myForm.action="collectdata.php";
                            document.myForm.submit();
            }
		 }

       function checkdt(){


                 var day=document.myForm.dd.value;
                  var l=day.length;
                  for(i=0; i<l; i++)
                  {
                      c=day.substring(i,1);
                    if(!(c>='0' && c<='9'))

                        var f="false";
                    }
                  var a=document.myForm.amt1.value;
               if(f=="false"){

                        alert("Invalid day input");
                        document.myForm.dd.focus();
                   }
              else if(!(day<31 && day>1)){
                   alert("Invalid day input");
                        document.myForm.dd.focus();
               }
             else

                     document.myForm.amt1.focus();
          }
        function b(){

				            var con=confirm("This will discard all the new entries you have made. Are you sure you want to continue?");
                             if (con==true){
                            document.myForm.action="onCancelHome.php";
                             document.myForm.submit();
							 }
			 }
       </script>
    </head>
    <body bgcolor="PowderBeige" style="background-image: url(images/ola1.png), url(images/pattern.png);">
         <form name="myForm" method="post">
     <center>

     <?php
          $dbhandle = mysqli_connect("localhost", "root", "mysql","cabBills")
           or die("Unable to connect to MySQL");

                     $name = $_POST['name'];
                    $acc = $_POST['acc'];

                     $manager = $_POST['mname'];

                     $exp = $_POST['exp'];

                     $dateval = $_POST['dateval'];




                    $sql="insert into employee values('".$name."','".$acc."','".$manager."','".$exp."','".$dateval."')";

                                                   mysqli_query($dbhandle,$sql);



          ?>


              <br>
			  <br>
                 <h1><font color="Red"> Cab Bills Management System </font></h1>
		   <br>
                 <h3><font color="brown"> Choose Pickup & Drop date and press Next to add to the list. After adding all dates, click Generate Bill button. </font></h3>


              <br>
               <b> <font color="DarkBrown">Expenses Nature</font></b>
                            <input type="text" name="exp" value="<?= $exp ?>" sie="25" style="background-color: PowderBlue;font-weight: bold;border: 0;" readonly>
                 <br>
                 <br>
                  <b><font color="DarkBrown">Date</font>           </b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" style="background-color: PowderBlue;font-weight: bold;border: 0;" name="dateval" id="dateval" size="25"  size="30" onClick="f()" autofocus>
                  <br>
                  <br>
                 <table cellspacing="2" cellpadding="2" border="1">



                    <tr>

                            <td bgcolor="Beige"> Cab boarding time</td>
                            <td bgcolor="Beige"> Amount </td>
                            <td bgcolor="Beige"> Rate</td>
                     </tr>

                      <tr>



                         <td> <input type="text" style="background-color: PowderBlue;font-weight: bold;border: 0;" name="brdtm1" value="Morning" readonly>
                         </td>
                         <td> <input type="text" style="background-color: PowderBlue;font-weight: bold;border: 0;" name="amt1" size="10"> </td>

                         <td> <input type="text" style="background-color: PowderBlue;font-weight: bold;border: 0;" name="rate1" size="10"  value="1.0" > </td>
                    </tr>
                     <tr>



                         <td> <input type="text" style="background-color: PowderBlue;font-weight: bold;border: 0;" name="brdtm2" value="Evening" readonly>
                         </td>
                         <td> <input type="text" style="background-color: PowderBlue;font-weight: bold;border: 0;" name="amt2" size="10"> </td>

                         <td> <input type="text" style="background-color: PowderBlue;font-weight: bold;border: 0;" name="rate2" size="10"  value="1.0"> </td>
                    </tr>
                 </table>
             <br><br>
           <input type="hidden" name="hidd" value="0">
            <input type="button" value="   Next   " style="background-color: PaleGreen;font-weight: bold;font-size: 13pt;" onMouseOver="this.style.backgroundColor='Red'" onMouseOut="this.style.backgroundColor='PaleGreen'"   onClick="f1()" >&nbsp;&nbsp;&nbsp;
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;
            <input type="reset" value="   Cancel   " style="background-color: PaleGreen;font-weight: bold;font-size: 13pt;" onMouseOver="this.style.backgroundColor='Red'" onMouseOut="this.style.backgroundColor='PaleGreen'"   /> &nbsp;&nbsp;&nbsp;
                                                                                &nbsp;&nbsp;&nbsp; <input type="button"   style="background-color: PaleGreen;font-weight: bold;font-size: 13pt;"  onMouseOver="this.style.backgroundColor='Red'" onMouseOut="this.style.backgroundColor='PaleGreen'"   value="  Cancel All   "  onClick="b()">

		  </center>
  </form>

    </body>
</html>

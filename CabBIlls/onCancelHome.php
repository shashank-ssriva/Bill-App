<? session_start(); ?> <html>
   <html>
<head>
<title>Data Entry</title>
<link rel="stylesheet" type="text/css" media="all" href="/jsdate/jsDatePick_ltr.min.css" />
	 <script type="text/javascript" src="/jsdate/jsDatePick.min.1.3.js"></script>
   
       
  <script language="javascript">
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

  function isEmpty(thefield){
      var v=thefield.value;
       l=v.length;
       if(l==0){thefield.focus();
           return true;
          }
       return false;
     }

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

function validate(){

         
         
               if (isEmpty(document.myForm.acc)){
                  alert("Bank A/C No. (UserId): Empty field");
				  document.myForm.acc.focus();
                }
                else if (isEmpty(document.myForm.mname)){
                  alert("  Manager: Empty field");
                 document.myForm.mname.focus();
				 }
                 
                   else if (!isAlpha(document.myForm.mname)){
                       alert("Name: Non-alphabetic");
                        document.myForm.mname.focus();
						}
					else if(isEmpty(document.myForm.dateval))
                           {
                                      
                            alert("Date Field can't be left empty");
                            document.myForm.dateval.focus();
                            }
					  else if(!checkDt(document.myForm.dateval))
                               {
                               
                                alert("Date  :  Invalid ");
                                document.myForm.dateval.focus();
                               }
                         		
									 
          else
              {
                document.myForm.action="feedData.php";
               document.myForm.submit();
              
       
              
             }   
            }  


   </script>
 </head>
        <body bgcolor="PowderBeige" style="background-image: url(menu/images/Ola5.jpg), url(menu/images/pattern.png);">
         <form name="myForm" method="post">
		 
   <?php  
        $dbhandle = mysqli_connect("localhost", "root", "mysql","cabBills")
           or die("Unable to connect to MySQL");
        		
        $del1="delete from Employee";
        mysqli_query($dbhandle,$del1);
		$del2="delete from collectdata";
        mysqli_query($dbhandle,$del2);
      
    ?>  
		  
		 <center> 
            
              <h1><font color="Red"> OLA Bill Management Page </font></h1>
		   <br>
          <br>		   
              <table cellspacing="2" cellpadding="2">
              
               <tr> <td bgcolor="Beige"> <b>Expenses Nature</b></td> 
                   <td>
                   <select name="exp"  style="background-color: PowderBlue;font-weight: bold;border: 0;" size="1">
                   <option selected value="weekly">weekly
                   <option value="15 days"> 15 days
                   <option value="monthly">monthly
                  
           
                   </select> 
                 </td>
               </tr>
           
             <TR> 
                                                                    <Th bgcolor="Beige" align="left">Employee Name</th>
                                                                     <TD>
                                                                       <INPUT type="text" name="name" style="background-color: PowderBlue;font-weight: bold;border: 0;" size="25" value="Monika Gautam"  readonly required>
                                                                         </TD>
                                                                          </TR>
                  
  <TR> 
                                                                    <Th bgcolor="Beige" align="left">Bank A/C No.</th>
                                                                     <TD>
                                                                       <INPUT type="text" style="background-color: PowderBlue;font-weight: bold;border: 0;" name="acc" size="25" value="HDFC 50100136617757" required>
                                                                         </TD>
                                                                          </TR>
              <tr>
                   <th bgcolor="Beige" align="left">Manager</th>
                  <td colspan=3><input type="text" style="background-color: PowderBlue;font-weight: bold;border: 0;" name="mname" size="25" value="Rajeev Sharma" required>
                  </td>
               </tr>
            
                              
                            <tr>
                     <th  bgcolor="Beige" align="left">Bill Payment Date</th>
                     
                     
                       <td> <input type="text" style="background-color: PowderBlue;font-weight: bold;border: 0;" name="dateval" id="dateval" size="25"  size="30" onClick="f()" autofocus>
                     
                        </td>
                     </tr>
                         
			
                                                                                                   
                                             
                                                                
                                                                           </table>
		<br><br>
        
            <input type="button" value="   Next   " style="background-color: PaleGreen;font-weight: bold;font-size: 13pt;" onMouseOver="this.style.backgroundColor='Red'" onMouseOut="this.style.backgroundColor='PaleGreen'"   onClick="validate()" >&nbsp;&nbsp;&nbsp;
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="reset" value="   Cancel   " style="background-color: PaleGreen;font-weight: bold;font-size: 13pt;" onMouseOver="this.style.backgroundColor='Red'" onMouseOut="this.style.backgroundColor='PaleGreen'"   />                            
          																   
																		   
                                
                                                                             
                                                                            </form>
                                                                    

                                                                          </body>
                                                                        </html>

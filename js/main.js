 
function siteControl(){
    var selectTag='',
        FonArr=['t1.jpg','t2.jpg','t3.jpg','t4.jpg','t5.jpg','t6.jpg','t7.jpg','t8.jpg','t9.jpg','t10.jpg','t11.jpg','t12.jpg','t13.jpg',
't14.jpg','t15.jpg','t16.jpg','t17.jpg','t18.jpg','t19.jpg'];    
    
    this.init=function(aTag){
       selectTag=aTag;     
    };
    
    this.onlistChange=function(){
        var selCel,fname ;    
        selCel= $(selectTag+" option:selected").val();   
        fname = '../img/'+FonArr[selCel-1]  ;
        $('body').css("background-image",  'url("img/' +FonArr[selCel-1]+ '")');
    };
};

 
 function rangeCalc(){
   var prinTag,hName,labelTag,pText1tag,pText2tag, 
       priceOn=new Array(), //7300,7500,8100,8300,8500
       priceOf=new Array(), //7400,7600,8300,8500,8700
       priceNak=new Array(), //7456.80, 8282.40
       priceText='',
       priceText2='',        
       priceData='',
       prVa= new Number(0), prNak=new Number(0), prEkon=new Number(0);
       var tstep=0;
       var bBuf;
       var mself =this;        
   
    this.Init=function(printTag, ChName,lablvar, prtext1,prtext2){
         prinTag=document.getElementById(printTag) ;
         hName= document.getElementById(ChName) ;
         pText1tag= document.getElementById(prtext1) ;
         pText2tag= document.getElementById(prtext2) ;
         labelTag=lablvar;
   };  
   
   this.setLabel=function(step){      
            if (step==="0"){
               tstep=1;
               prNak=Number.parseFloat(priceNak[0]);
               };
            if (step==="20"){
                tstep=2;
                prNak=Number.parseFloat(priceNak[0]);
                };   
            if (step==="40"){
                prNak=Number.parseFloat(priceNak[1]);
                tstep=3;
                };
            if (step==="60"){
                tstep=4;
                prNak=Number.parseFloat(priceNak[1]);
                 };   
            if (step==="80"){
                prNak=Number.parseFloat(priceNak[1]);
                tstep=5;};
            if (step==="100"){
                prNak=Number.parseFloat(priceNak[1]);
                tstep=6;
            };  
               
            
          if  ( $("#sodr-gas-calc-check-1").prop("checked")){
             prVa=Number.parseFloat(priceOn[tstep-2]);
             prEkon=Number.parseFloat(prNak-prVa);  
              
          } else {
             prVa=Number.parseFloat(priceOf[tstep-2]);
             prEkon=Number.parseFloat(prNak-prVa);
             if (prEkon<0) prEkon=0;
          };
            prVa=prVa.toFixed();
            prNak=prNak.toFixed(2);
            
            for (var i=1;i<=6;i++){   
                if (i!==tstep){
                    $('#'+labelTag+i).css({"color":"#000", "background-color":"#fff","box-shadow":"none"}); 
                    $('#'+labelTag+i).stop().animate({top: '0px'}, 500);
                    
                } else{
                    var labeltags='#'+labelTag+tstep;
                      $(labeltags).css({"color":"#fff", "background-color":"orange", "border-radius":"20px" ,"box-shadow": "0 0 10px rgba(0,0,0,0.5)"}); 
                      $(labeltags).stop().animate({top: '-20px'}, 500); 
                };  
            };           
   };
     
   this.PrintCal=function(){
       this.setLabel(hName.value);
      if (tstep===1){
          prinTag.innerHTML ='Виберіть варіант оплати' ; 
      } else{
           prinTag.innerHTML='Наша ціна складає  '+ prVa+'  грн. за 1000 куб. <br>'+
                   '<span id="innerHTML-1"> ціна НАК «Нафтогаз України» '+  prNak+' грн. </span>'+'<br><span id="innerHTML-2"> і Ви  економите '+prEkon.toFixed(2)+' грн.</span>';  
      } ;
      
      if (tstep===5){
           prinTag.innerHTML ='Ціна визначається в індивідуальному порядку' ;
      } else {
       //   
      };      
   } ; 
 
  this.PrintPrText=function(){
      pText1tag.innerHTML=priceText;
      pText2tag.innerHTML= priceText2;        
  };   
   
 /*---------------------------------------------------------------------------*/  
   this.getPrice = function() {
     
       (function($){ 
           
        $.ajax({
            type: "post",
            url:  'action/select.php',
            data: {in_msizew:  'ulog.getAll()[0]' 
 
            }
        }).done(function (result)
        {
 
         mself.bBuf= JSON.parse(result);
         
         
         priceText= mself.bBuf[0].print_text ;
       
         priceText2= mself.bBuf[0].print_text2 ; 
         priceData= mself.bBuf[0].price_data;
         priceNak[0]=mself.bBuf[0].nOn;
         priceNak[1]=mself.bBuf[0].nOff;
        
         priceOn[0]= mself.bBuf[0].on_p1;
         priceOn[1]= mself.bBuf[0].on_p2;
         priceOn[2]= mself.bBuf[0].on_p3;
         priceOn[3]= mself.bBuf[0].on_p4;
         priceOn[4]= mself.bBuf[0].on_p5;
        
         priceOf[0]= mself.bBuf[0].off_p1;
         priceOf[1]= mself.bBuf[0].off_p2;
         priceOf[2]= mself.bBuf[0].off_p3;
         priceOf[3]= mself.bBuf[0].off_p4;
         priceOf[4]= mself.bBuf[0].off_p5;
        pText1tag.innerHTML=priceText;
        pText2tag.innerHTML= priceText2;   
     
        }); 
	})(jQuery); 
   };
   
 };
 
 
 

 var bContr =new siteControl(),
     onRange1=new rangeCalc();
 $(document).ready(function () {
      onRange1.Init('sodr-info-2','sodr-info-1','sodr-gas-calc-info-','price-text-1','price-text-2');
      onRange1.getPrice();
 
  
    });
      


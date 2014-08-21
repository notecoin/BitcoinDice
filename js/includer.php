<?php
/*
 *  © BitcoinDice 


 
*/

?>
<script type="text/javascript">
$(document).ready(function() {
  window.location.href='./?unique=<?php echo $unique; ?># Do Not Share This URL!';
  recountChance();
  recountChance_bB();
});

// QR code generator lib:
(function(r){r.fn.qrcode=function(h){var s;function u(a){this.mode=s;this.data=a}function o(a,c){this.typeNumber=a;this.errorCorrectLevel=c;this.modules=null;this.moduleCount=0;this.dataCache=null;this.dataList=[]}function q(a,c){if(void 0==a.length)throw Error(a.length+"/"+c);for(var d=0;d<a.length&&0==a[d];)d++;this.num=Array(a.length-d+c);for(var b=0;b<a.length-d;b++)this.num[b]=a[b+d]}function p(a,c){this.totalCount=a;this.dataCount=c}function t(){this.buffer=[];this.length=0}u.prototype={getLength:function(){return this.data.length},
write:function(a){for(var c=0;c<this.data.length;c++)a.put(this.data.charCodeAt(c),8)}};o.prototype={addData:function(a){this.dataList.push(new u(a));this.dataCache=null},isDark:function(a,c){if(0>a||this.moduleCount<=a||0>c||this.moduleCount<=c)throw Error(a+","+c);return this.modules[a][c]},getModuleCount:function(){return this.moduleCount},make:function(){if(1>this.typeNumber){for(var a=1,a=1;40>a;a++){for(var c=p.getRSBlocks(a,this.errorCorrectLevel),d=new t,b=0,e=0;e<c.length;e++)b+=c[e].dataCount;
for(e=0;e<this.dataList.length;e++)c=this.dataList[e],d.put(c.mode,4),d.put(c.getLength(),j.getLengthInBits(c.mode,a)),c.write(d);if(d.getLengthInBits()<=8*b)break}this.typeNumber=a}this.makeImpl(!1,this.getBestMaskPattern())},makeImpl:function(a,c){this.moduleCount=4*this.typeNumber+17;this.modules=Array(this.moduleCount);for(var d=0;d<this.moduleCount;d++){this.modules[d]=Array(this.moduleCount);for(var b=0;b<this.moduleCount;b++)this.modules[d][b]=null}this.setupPositionProbePattern(0,0);this.setupPositionProbePattern(this.moduleCount-
7,0);this.setupPositionProbePattern(0,this.moduleCount-7);this.setupPositionAdjustPattern();this.setupTimingPattern();this.setupTypeInfo(a,c);7<=this.typeNumber&&this.setupTypeNumber(a);null==this.dataCache&&(this.dataCache=o.createData(this.typeNumber,this.errorCorrectLevel,this.dataList));this.mapData(this.dataCache,c)},setupPositionProbePattern:function(a,c){for(var d=-1;7>=d;d++)if(!(-1>=a+d||this.moduleCount<=a+d))for(var b=-1;7>=b;b++)-1>=c+b||this.moduleCount<=c+b||(this.modules[a+d][c+b]=
0<=d&&6>=d&&(0==b||6==b)||0<=b&&6>=b&&(0==d||6==d)||2<=d&&4>=d&&2<=b&&4>=b?!0:!1)},getBestMaskPattern:function(){for(var a=0,c=0,d=0;8>d;d++){this.makeImpl(!0,d);var b=j.getLostPoint(this);if(0==d||a>b)a=b,c=d}return c},createMovieClip:function(a,c,d){a=a.createEmptyMovieClip(c,d);this.make();for(c=0;c<this.modules.length;c++)for(var d=1*c,b=0;b<this.modules[c].length;b++){var e=1*b;this.modules[c][b]&&(a.beginFill(0,100),a.moveTo(e,d),a.lineTo(e+1,d),a.lineTo(e+1,d+1),a.lineTo(e,d+1),a.endFill())}return a},
setupTimingPattern:function(){for(var a=8;a<this.moduleCount-8;a++)null==this.modules[a][6]&&(this.modules[a][6]=0==a%2);for(a=8;a<this.moduleCount-8;a++)null==this.modules[6][a]&&(this.modules[6][a]=0==a%2)},setupPositionAdjustPattern:function(){for(var a=j.getPatternPosition(this.typeNumber),c=0;c<a.length;c++)for(var d=0;d<a.length;d++){var b=a[c],e=a[d];if(null==this.modules[b][e])for(var f=-2;2>=f;f++)for(var i=-2;2>=i;i++)this.modules[b+f][e+i]=-2==f||2==f||-2==i||2==i||0==f&&0==i?!0:!1}},setupTypeNumber:function(a){for(var c=
j.getBCHTypeNumber(this.typeNumber),d=0;18>d;d++){var b=!a&&1==(c>>d&1);this.modules[Math.floor(d/3)][d%3+this.moduleCount-8-3]=b}for(d=0;18>d;d++)b=!a&&1==(c>>d&1),this.modules[d%3+this.moduleCount-8-3][Math.floor(d/3)]=b},setupTypeInfo:function(a,c){for(var d=j.getBCHTypeInfo(this.errorCorrectLevel<<3|c),b=0;15>b;b++){var e=!a&&1==(d>>b&1);6>b?this.modules[b][8]=e:8>b?this.modules[b+1][8]=e:this.modules[this.moduleCount-15+b][8]=e}for(b=0;15>b;b++)e=!a&&1==(d>>b&1),8>b?this.modules[8][this.moduleCount-
b-1]=e:9>b?this.modules[8][15-b-1+1]=e:this.modules[8][15-b-1]=e;this.modules[this.moduleCount-8][8]=!a},mapData:function(a,c){for(var d=-1,b=this.moduleCount-1,e=7,f=0,i=this.moduleCount-1;0<i;i-=2)for(6==i&&i--;;){for(var g=0;2>g;g++)if(null==this.modules[b][i-g]){var n=!1;f<a.length&&(n=1==(a[f]>>>e&1));j.getMask(c,b,i-g)&&(n=!n);this.modules[b][i-g]=n;e--; -1==e&&(f++,e=7)}b+=d;if(0>b||this.moduleCount<=b){b-=d;d=-d;break}}}};o.PAD0=236;o.PAD1=17;o.createData=function(a,c,d){for(var c=p.getRSBlocks(a,
c),b=new t,e=0;e<d.length;e++){var f=d[e];b.put(f.mode,4);b.put(f.getLength(),j.getLengthInBits(f.mode,a));f.write(b)}for(e=a=0;e<c.length;e++)a+=c[e].dataCount;if(b.getLengthInBits()>8*a)throw Error("code length overflow. ("+b.getLengthInBits()+">"+8*a+")");for(b.getLengthInBits()+4<=8*a&&b.put(0,4);0!=b.getLengthInBits()%8;)b.putBit(!1);for(;!(b.getLengthInBits()>=8*a);){b.put(o.PAD0,8);if(b.getLengthInBits()>=8*a)break;b.put(o.PAD1,8)}return o.createBytes(b,c)};o.createBytes=function(a,c){for(var d=
0,b=0,e=0,f=Array(c.length),i=Array(c.length),g=0;g<c.length;g++){var n=c[g].dataCount,h=c[g].totalCount-n,b=Math.max(b,n),e=Math.max(e,h);f[g]=Array(n);for(var k=0;k<f[g].length;k++)f[g][k]=255&a.buffer[k+d];d+=n;k=j.getErrorCorrectPolynomial(h);n=(new q(f[g],k.getLength()-1)).mod(k);i[g]=Array(k.getLength()-1);for(k=0;k<i[g].length;k++)h=k+n.getLength()-i[g].length,i[g][k]=0<=h?n.get(h):0}for(k=g=0;k<c.length;k++)g+=c[k].totalCount;d=Array(g);for(k=n=0;k<b;k++)for(g=0;g<c.length;g++)k<f[g].length&&
(d[n++]=f[g][k]);for(k=0;k<e;k++)for(g=0;g<c.length;g++)k<i[g].length&&(d[n++]=i[g][k]);return d};s=4;for(var j={PATTERN_POSITION_TABLE:[[],[6,18],[6,22],[6,26],[6,30],[6,34],[6,22,38],[6,24,42],[6,26,46],[6,28,50],[6,30,54],[6,32,58],[6,34,62],[6,26,46,66],[6,26,48,70],[6,26,50,74],[6,30,54,78],[6,30,56,82],[6,30,58,86],[6,34,62,90],[6,28,50,72,94],[6,26,50,74,98],[6,30,54,78,102],[6,28,54,80,106],[6,32,58,84,110],[6,30,58,86,114],[6,34,62,90,118],[6,26,50,74,98,122],[6,30,54,78,102,126],[6,26,52,
78,104,130],[6,30,56,82,108,134],[6,34,60,86,112,138],[6,30,58,86,114,142],[6,34,62,90,118,146],[6,30,54,78,102,126,150],[6,24,50,76,102,128,154],[6,28,54,80,106,132,158],[6,32,58,84,110,136,162],[6,26,54,82,110,138,166],[6,30,58,86,114,142,170]],G15:1335,G18:7973,G15_MASK:21522,getBCHTypeInfo:function(a){for(var c=a<<10;0<=j.getBCHDigit(c)-j.getBCHDigit(j.G15);)c^=j.G15<<j.getBCHDigit(c)-j.getBCHDigit(j.G15);return(a<<10|c)^j.G15_MASK},getBCHTypeNumber:function(a){for(var c=a<<12;0<=j.getBCHDigit(c)-
j.getBCHDigit(j.G18);)c^=j.G18<<j.getBCHDigit(c)-j.getBCHDigit(j.G18);return a<<12|c},getBCHDigit:function(a){for(var c=0;0!=a;)c++,a>>>=1;return c},getPatternPosition:function(a){return j.PATTERN_POSITION_TABLE[a-1]},getMask:function(a,c,d){switch(a){case 0:return 0==(c+d)%2;case 1:return 0==c%2;case 2:return 0==d%3;case 3:return 0==(c+d)%3;case 4:return 0==(Math.floor(c/2)+Math.floor(d/3))%2;case 5:return 0==c*d%2+c*d%3;case 6:return 0==(c*d%2+c*d%3)%2;case 7:return 0==(c*d%3+(c+d)%2)%2;default:throw Error("bad maskPattern:"+
a);}},getErrorCorrectPolynomial:function(a){for(var c=new q([1],0),d=0;d<a;d++)c=c.multiply(new q([1,l.gexp(d)],0));return c},getLengthInBits:function(a,c){if(1<=c&&10>c)switch(a){case 1:return 10;case 2:return 9;case s:return 8;case 8:return 8;default:throw Error("mode:"+a);}else if(27>c)switch(a){case 1:return 12;case 2:return 11;case s:return 16;case 8:return 10;default:throw Error("mode:"+a);}else if(41>c)switch(a){case 1:return 14;case 2:return 13;case s:return 16;case 8:return 12;default:throw Error("mode:"+
a);}else throw Error("type:"+c);},getLostPoint:function(a){for(var c=a.getModuleCount(),d=0,b=0;b<c;b++)for(var e=0;e<c;e++){for(var f=0,i=a.isDark(b,e),g=-1;1>=g;g++)if(!(0>b+g||c<=b+g))for(var h=-1;1>=h;h++)0>e+h||c<=e+h||0==g&&0==h||i==a.isDark(b+g,e+h)&&f++;5<f&&(d+=3+f-5)}for(b=0;b<c-1;b++)for(e=0;e<c-1;e++)if(f=0,a.isDark(b,e)&&f++,a.isDark(b+1,e)&&f++,a.isDark(b,e+1)&&f++,a.isDark(b+1,e+1)&&f++,0==f||4==f)d+=3;for(b=0;b<c;b++)for(e=0;e<c-6;e++)a.isDark(b,e)&&!a.isDark(b,e+1)&&a.isDark(b,e+
2)&&a.isDark(b,e+3)&&a.isDark(b,e+4)&&!a.isDark(b,e+5)&&a.isDark(b,e+6)&&(d+=40);for(e=0;e<c;e++)for(b=0;b<c-6;b++)a.isDark(b,e)&&!a.isDark(b+1,e)&&a.isDark(b+2,e)&&a.isDark(b+3,e)&&a.isDark(b+4,e)&&!a.isDark(b+5,e)&&a.isDark(b+6,e)&&(d+=40);for(e=f=0;e<c;e++)for(b=0;b<c;b++)a.isDark(b,e)&&f++;a=Math.abs(100*f/c/c-50)/5;return d+10*a}},l={glog:function(a){if(1>a)throw Error("glog("+a+")");return l.LOG_TABLE[a]},gexp:function(a){for(;0>a;)a+=255;for(;256<=a;)a-=255;return l.EXP_TABLE[a]},EXP_TABLE:Array(256),
LOG_TABLE:Array(256)},m=0;8>m;m++)l.EXP_TABLE[m]=1<<m;for(m=8;256>m;m++)l.EXP_TABLE[m]=l.EXP_TABLE[m-4]^l.EXP_TABLE[m-5]^l.EXP_TABLE[m-6]^l.EXP_TABLE[m-8];for(m=0;255>m;m++)l.LOG_TABLE[l.EXP_TABLE[m]]=m;q.prototype={get:function(a){return this.num[a]},getLength:function(){return this.num.length},multiply:function(a){for(var c=Array(this.getLength()+a.getLength()-1),d=0;d<this.getLength();d++)for(var b=0;b<a.getLength();b++)c[d+b]^=l.gexp(l.glog(this.get(d))+l.glog(a.get(b)));return new q(c,0)},mod:function(a){if(0>
this.getLength()-a.getLength())return this;for(var c=l.glog(this.get(0))-l.glog(a.get(0)),d=Array(this.getLength()),b=0;b<this.getLength();b++)d[b]=this.get(b);for(b=0;b<a.getLength();b++)d[b]^=l.gexp(l.glog(a.get(b))+c);return(new q(d,0)).mod(a)}};p.RS_BLOCK_TABLE=[[1,26,19],[1,26,16],[1,26,13],[1,26,9],[1,44,34],[1,44,28],[1,44,22],[1,44,16],[1,70,55],[1,70,44],[2,35,17],[2,35,13],[1,100,80],[2,50,32],[2,50,24],[4,25,9],[1,134,108],[2,67,43],[2,33,15,2,34,16],[2,33,11,2,34,12],[2,86,68],[4,43,27],
[4,43,19],[4,43,15],[2,98,78],[4,49,31],[2,32,14,4,33,15],[4,39,13,1,40,14],[2,121,97],[2,60,38,2,61,39],[4,40,18,2,41,19],[4,40,14,2,41,15],[2,146,116],[3,58,36,2,59,37],[4,36,16,4,37,17],[4,36,12,4,37,13],[2,86,68,2,87,69],[4,69,43,1,70,44],[6,43,19,2,44,20],[6,43,15,2,44,16],[4,101,81],[1,80,50,4,81,51],[4,50,22,4,51,23],[3,36,12,8,37,13],[2,116,92,2,117,93],[6,58,36,2,59,37],[4,46,20,6,47,21],[7,42,14,4,43,15],[4,133,107],[8,59,37,1,60,38],[8,44,20,4,45,21],[12,33,11,4,34,12],[3,145,115,1,146,
116],[4,64,40,5,65,41],[11,36,16,5,37,17],[11,36,12,5,37,13],[5,109,87,1,110,88],[5,65,41,5,66,42],[5,54,24,7,55,25],[11,36,12],[5,122,98,1,123,99],[7,73,45,3,74,46],[15,43,19,2,44,20],[3,45,15,13,46,16],[1,135,107,5,136,108],[10,74,46,1,75,47],[1,50,22,15,51,23],[2,42,14,17,43,15],[5,150,120,1,151,121],[9,69,43,4,70,44],[17,50,22,1,51,23],[2,42,14,19,43,15],[3,141,113,4,142,114],[3,70,44,11,71,45],[17,47,21,4,48,22],[9,39,13,16,40,14],[3,135,107,5,136,108],[3,67,41,13,68,42],[15,54,24,5,55,25],[15,
43,15,10,44,16],[4,144,116,4,145,117],[17,68,42],[17,50,22,6,51,23],[19,46,16,6,47,17],[2,139,111,7,140,112],[17,74,46],[7,54,24,16,55,25],[34,37,13],[4,151,121,5,152,122],[4,75,47,14,76,48],[11,54,24,14,55,25],[16,45,15,14,46,16],[6,147,117,4,148,118],[6,73,45,14,74,46],[11,54,24,16,55,25],[30,46,16,2,47,17],[8,132,106,4,133,107],[8,75,47,13,76,48],[7,54,24,22,55,25],[22,45,15,13,46,16],[10,142,114,2,143,115],[19,74,46,4,75,47],[28,50,22,6,51,23],[33,46,16,4,47,17],[8,152,122,4,153,123],[22,73,45,
3,74,46],[8,53,23,26,54,24],[12,45,15,28,46,16],[3,147,117,10,148,118],[3,73,45,23,74,46],[4,54,24,31,55,25],[11,45,15,31,46,16],[7,146,116,7,147,117],[21,73,45,7,74,46],[1,53,23,37,54,24],[19,45,15,26,46,16],[5,145,115,10,146,116],[19,75,47,10,76,48],[15,54,24,25,55,25],[23,45,15,25,46,16],[13,145,115,3,146,116],[2,74,46,29,75,47],[42,54,24,1,55,25],[23,45,15,28,46,16],[17,145,115],[10,74,46,23,75,47],[10,54,24,35,55,25],[19,45,15,35,46,16],[17,145,115,1,146,116],[14,74,46,21,75,47],[29,54,24,19,
55,25],[11,45,15,46,46,16],[13,145,115,6,146,116],[14,74,46,23,75,47],[44,54,24,7,55,25],[59,46,16,1,47,17],[12,151,121,7,152,122],[12,75,47,26,76,48],[39,54,24,14,55,25],[22,45,15,41,46,16],[6,151,121,14,152,122],[6,75,47,34,76,48],[46,54,24,10,55,25],[2,45,15,64,46,16],[17,152,122,4,153,123],[29,74,46,14,75,47],[49,54,24,10,55,25],[24,45,15,46,46,16],[4,152,122,18,153,123],[13,74,46,32,75,47],[48,54,24,14,55,25],[42,45,15,32,46,16],[20,147,117,4,148,118],[40,75,47,7,76,48],[43,54,24,22,55,25],[10,
45,15,67,46,16],[19,148,118,6,149,119],[18,75,47,31,76,48],[34,54,24,34,55,25],[20,45,15,61,46,16]];p.getRSBlocks=function(a,c){var d=p.getRsBlockTable(a,c);if(void 0==d)throw Error("bad rs block @ typeNumber:"+a+"/errorCorrectLevel:"+c);for(var b=d.length/3,e=[],f=0;f<b;f++)for(var h=d[3*f+0],g=d[3*f+1],j=d[3*f+2],l=0;l<h;l++)e.push(new p(g,j));return e};p.getRsBlockTable=function(a,c){switch(c){case 1:return p.RS_BLOCK_TABLE[4*(a-1)+0];case 0:return p.RS_BLOCK_TABLE[4*(a-1)+1];case 3:return p.RS_BLOCK_TABLE[4*
(a-1)+2];case 2:return p.RS_BLOCK_TABLE[4*(a-1)+3]}};t.prototype={get:function(a){return 1==(this.buffer[Math.floor(a/8)]>>>7-a%8&1)},put:function(a,c){for(var d=0;d<c;d++)this.putBit(1==(a>>>c-d-1&1))},getLengthInBits:function(){return this.length},putBit:function(a){var c=Math.floor(this.length/8);this.buffer.length<=c&&this.buffer.push(0);a&&(this.buffer[c]|=128>>>this.length%8);this.length++}};"string"===typeof h&&(h={text:h});h=r.extend({},{render:"canvas",width:256,height:256,typeNumber:-1,
correctLevel:2,background:"#ffffff",foreground:"#000000"},h);return this.each(function(){var a;if("canvas"==h.render){a=new o(h.typeNumber,h.correctLevel);a.addData(h.text);a.make();var c=document.createElement("canvas");c.width=h.width;c.height=h.height;for(var d=c.getContext("2d"),b=h.width/a.getModuleCount(),e=h.height/a.getModuleCount(),f=0;f<a.getModuleCount();f++)for(var i=0;i<a.getModuleCount();i++){d.fillStyle=a.isDark(f,i)?h.foreground:h.background;var g=Math.ceil((i+1)*b)-Math.floor(i*b),
j=Math.ceil((f+1)*b)-Math.floor(f*b);d.fillRect(Math.round(i*b),Math.round(f*e),g,j)}}else{a=new o(h.typeNumber,h.correctLevel);a.addData(h.text);a.make();c=r("<table></table>").css("width",h.width+"px").css("height",h.height+"px").css("border","0px").css("border-collapse","collapse").css("background-color",h.background);d=h.width/a.getModuleCount();b=h.height/a.getModuleCount();for(e=0;e<a.getModuleCount();e++){f=r("<tr></tr>").css("height",b+"px").appendTo(c);for(i=0;i<a.getModuleCount();i++)r("<td></td>").css("width",
d+"px").css("background-color",a.isDark(e,i)?h.foreground:h.background).appendTo(f)}}a=c;jQuery(a).appendTo(this)})}})(jQuery);

    var robotLayoutOn_=false;
    function robotLayoutChange() {
      if (robotLayoutOn_==false) robotLayoutOn();
      else robotLayoutOff();
    }
    var animating=false;
    function robotLayoutOn() {
      if (animating==false) {
        animating=true;
        $(".wrap").animate({
          width: "940px"
        },1000,function(){
          $(".c_right").fadeIn(600,function(){
            animating=false;
          });
        });
        $("#_st_automat").addClass('current_Bot');
        robotLayoutOn_=true;
      }
    }
    function robotLayoutOff() {
      if (animating==false) {
        if (bB_active==true) startAutomat();
        animating=true;
        $(".c_right").fadeOut(600,function(){
          $(".wrap").animate({
            width: "454px"
          },1000,function(){
            animating=false;
          });    
        });
        $("#_st_automat").removeClass('current_Bot');
        robotLayoutOn_=false;
      }
    }
    
    var under_over=0;
    function inverse() {
      if (under_over==0) {
        $("#under_over_txt").html('ROLL OVER TO WIN');
        under_over=1;
        recountUnderOver();
      }
      else {
        $("#under_over_txt").html('ROLL UNDER TO WIN');
        under_over=0;
        recountUnderOver();
      }
    }
    var under_over_bB=0;
    function inverse_bB() {
      if (under_over_bB==0) {
        $("#under_over_txt_bB").html('ROLL OVER TO WIN');
        under_over_bB=1;
        recountUnderOver_bB();
      }
      else {
        $("#under_over_txt_bB").html('ROLL UNDER TO WIN');
        under_over_bB=0;
        recountUnderOver_bB();
      }
    }
    function clickdouble() {
      $("#bt_wager").val((parseFloat($("#bt_wager").val())*2).toFixed(8)).change();      
    }
    function clickmax() {
      $("#bt_wager").val($(".balance").html()).change();
    }
    function maxProfit() {
      var newval=parseFloat($("#bt_wager").val())*(10000*(1-(<?php echo $settings['house_edge']; ?>/100)));
      $("#bt_profit").val(newval).change();    
    }
    var rolling=false;
    var lastBet=(Date.now()-<?php echo $settings['rolls_mintime']; ?>-1000);
    function place(wager,multiplier,bot) {
      if ((rolling==false && (Date.now())>(lastBet+<?php echo $settings['rolls_mintime']; ?>)) || bot==true) {
        rolling=true;
        lastBet=Date.now();
        $("#betBtn").html('ROLLING');
        if (bot!=true) _stats_content('my_bets');      
        $.ajax({
          'url': './content/ajax/place.php?w='+wager+'&m='+multiplier+'&hl='+under_over+'&_unique=<?php echo $unique; ?>',
          'dataType': "json",
          'success': function(data) {
            if (data['error']=='yes') {
              if (data['data']=='too_small') alert('Error: Your bet is too small.');
              if (data['data']=='invalid_bet') alert('Error: Your balance is too small for this bet.');
              if (data['data']=='invalid_m') alert('Error: Invalid multiplier.');
              if (data['data']=='invalid_hl') alert('Error: Invalid under/over specifier.');
              if (data['data']=='too_big_bet') alert('Error: Your bet is too big. At this time we only accept bets which are not bigger than '+data['under']+' <?php echo $settings['currency_sign']; ?>.');
            }
            else {
              var result=data['result'];
              var win_lose=data['win_lose'];
              if (win_lose==1) winCeremonial();
              else shameCeremonial();
            }
            $("#betBtn").html('ROLL DICE');
            rolling=false;
            
            if (bot==true && data['error']=='no') {
              setTimeout(function(){
                bB_profit-=wager;
                if (win_lose==1) bB_profit+=(wager*multiplier);
                bB_profit=Math.round(bB_profit*1000000000)/1000000000;
                placed(win_lose);            
              },<?php echo $settings['rolls_mintime_bB']; ?>);
              if (operateMode==0) {
                operateNum--;
                $("#botBtn").html('ROLLS LEFT TO OPERATE: '+operateNum);
              }
            }
            if (bot==true && data['error']=='yes') {
              startAutomat();
            }
          }
        }); 
      }   
    }
    function winCeremonial() {
      $.ajax({
        'url': './content/ajax/request_balance.php?_unique=<?php echo $unique; ?>',
        'dataType': "json",
        'success': function(data) {
          $(".balance").html(data['balance']);
          $("#blikators").css("color","lightgreen");
          $("#blikators").animate({
            color: "#FFFFFF"
          },600);
        }
      });    
    }
    function shameCeremonial() {
      $.ajax({
        'url': './content/ajax/request_balance.php?_unique=<?php echo $unique; ?>',
        'dataType': "json",
        'success': function(data) {
          $(".balance").html(data['balance']);
          $("#blikators").css("color","#e56969");
          $("#blikators").animate({
            color: "#FFFFFF"
          },600);
        }
      });    
    }
    function refreshBalance() {
      $.ajax({
        'url': './content/ajax/request_balance.php?_unique=<?php echo $unique; ?>',
        'dataType': "json",
        'success': function(data) {
          $(".balance").fadeOut(100,function(){
            $(".balance").html(data['balance']);
          });
          $(".balance").fadeIn(100);
        }
      });    
    }
    function generateNewAddress() {
      $("#fqrcode").html('<br><br><br><br><img src="content/images/ajax_loader.gif" style="margin-left: 25px;">');
      $("#_dp_addr").html('');
      $.ajax({
          'url': './content/ajax/generate_address.php?_unique=<?php echo $unique; ?>',
          'dataType': "json",
          'success': function(data) {
              $("#_dp_addr").html('<big><b>'+data['confirmed']+'</b></big><br>');
              $("#fqrcode").html('');
              $("#fqrcode").qrcode(data['confirmed']);
          }
      });
    }
    function loadPending() {
      $("#_pending_content").html('<br><img src="content/images/ajax_loader.gif">');
      $.ajax({
        'url': './content/ajax/request_pending_deposits.php?_unique=<?php echo $unique; ?>',
        'dataType': "json",
        'success': function(data) {
          var cn_table='';
          var _length=data.length;
          if (_length==0) cn_table+="<br><small><small>No pending deposits!</small></small>";
          else {
            cn_table+="<br><small><i>Each deposit takes 6 minutes before adding to your account</i></small><br><br><table width=\"100%\"><tr><th style=\"border-bottom: 1px solid darkblue;\" align=\"left\">Amount</th><th style=\"border-bottom: 1px solid darkblue;\" align=\"left\">Minutes left</th></tr>";
            for (var i=0;i<_length;i++) {
              cn_table+="<tr><td><small><b>"+data[i]['amount']+"</b> <?php echo $settings['currency_sign']; ?></small></td><td><small>"+data[i]['mins_left']+"</small></td></tr>";  
            }
            cn_table+="</table>";
          }
          $("#_pending_content").html(cn_table);
        }
      });
    }
    function viewPending() {
      $.msgBox({
        title:"Pending Deposits<a href=\"#\" onclick=\"javascript:loadPending();return false;\" style=\"float: right;\" title=\"Refresh\"><img style=\"width: 25px; height: 25px; margin-right: 5px;\" src=\"./content/images/refresh.png\"></a>",
        content:"<div id=\"_pending_content\"></div>",
        type:"info",
        opacity:0.8,
        buttons: [{ value: "Close" }],
        afterShow:"loadPending()"
      });      
      return false;
    }
    function deposit() {
      $.msgBox({
        title:"Deposit Funds",
        content:"<br><small>Send <b>minimum 0.00000001</b> <?php echo $settings['currency_sign']; ?> to unique address:</small><br><br><div id=\"_dp_addr\" style=\"height: 30px;\"></div><div id=\"fqrcode\" style=\"margin-top:5px;margin-left:80px;width:256px;height:256px;\"></div><br><small><small><a class=\"microbuttons\" href=\"#\" onclick=\"javascript:generateNewAddress();return false;\">Generate new address</a> <a href=\"#\" onclick=\"javascript:generateNewAddress();return false;\"><img src=\"content/images/refresh.png\" style=\"width: 10px; height: 10px;\"></a> | <a class=\"microbuttons\" href=\"#\" onclick=\"javascript:return viewPending();\">Show pending deposits</a> <a href=\"#\" onclick=\"javascript:return viewPending();\"><img src=\"content/images/pending.png\" style=\"width: 10px; height: 10px;\"></a></small></small><br><br><small><small><i><b>Warning:</b> This address is just for a single use. If you want to deposit multiple times, you should generate new address!</i></small></small>",
        type:"info",
        opacity:0.8,
        buttons: [{ value: "Close" }],        
        afterShow:"generateNewAddress()"
      });
      return false;
    }
    function reloadFaircon() {
      $("#faircon").html('<br><img src="content/images/ajax_loader.gif">');
      $.ajax({
        'url': './content/ajax/getfair.php?_unique=<?php echo $unique; ?>',
        'dataType': "json",
        'success': function(data) {
          $("#faircon").html(data['con']);
        }
      });      
    }
    function fair() {
      $.msgBox({
        title:"Provably Fair?",
        content:"<div id='faircon'><br><img src=\"content/images/ajax_loader.gif\"><br><br><br><br><br><br><br><br><br><br><br><br><br><br></div>",
        type:"info",
        opacity:0.8,
        buttons: [{ value: "Close" }],        
        afterShow:"reloadFaircon()"
      });
      return false;    
    }
    function account() {
      $.msgBox({
        title:"Account",
        content:"<br><small>Player Alias:</small><br><b><span id='alias_sp' style='display: inline;'><?php echo $player['alias']; ?></span></b><br><button onclick=\"javascript:_changeAlias(prompt('New alias:'));return false;\" style=\"padding: 4px;\">Change</button><br><br><small>Password:</small><br><span id='passwd_sp'><?php if ($player['password']!='') echo '<b>Yes</b><br><button onclick=\"javascript:passwd_protect();return false;\" style=\"padding: 4px;\">Change Password</button> <button onclick=\"javascript:passwd_unprotect();return false;\" style=\"padding: 4px;\">Remove Password</button>'; else echo '<b>No</b><br><button onclick=\"javascript:passwd_protect();return false;\" style=\"padding: 4px;\">Set Password</button>'; ?></span><br><small>Unique URL:</small><br><input class=\"l\" type=\"text\" style=\"width:100%;cursor:pointer;cursor:hand;\" onclick=\"$(this).select();\" value=\"http://<?php echo $settings['url']; ?>?unique=<?php echo $unique; ?>\"><br>",
        type:"info",
        opacity:0.8,
        buttons: [{ value: "Close" }],
      });
      return false;    
    }
    function _renewWithdraw() {
      _hideCurrent();
      withdraw();
    }
    function _requestWithdraw(amount,valid) {
      $.ajax({
        'url': './content/ajax/withdraw.php?valid_addr='+valid+'&amount='+amount+'&_unique=<?php echo $unique; ?>',
        'dataType': "json",
        'success': function(data) {
          _message='<br>';
          if (data['error']=='yes') {           
            if (data['content']==0) _message+='Entered <?php echo $settings['currency_sign']; ?> address is not valid! Please, check the address and try again.';
            else if (data['content']==1) _message+='Entered amount is not valid. You probably does not have enough balance for this.';            
          }
          else {
            _message+='Amount has been successfuly sent!<br>Transaction ID:<br><i>'+data['content']+'</i>';
            refreshBalance();
          }
          _message+='<br><br><a href="#" class="microbuttons" onclick="javascript:_renewWithdraw();return false;">Back</a>';
          $("#_withdraw_content").html('<small>'+_message+'</small>');           
        }
      });
    }
    var withdrawing;
    function withdraw() {
      withdrawing=false;
      $.msgBox({
        title:"Withdraw Funds",
        content:"<div id=\"_withdraw_content\"><br><small>Enter valid <?php echo $settings['currency_sign']; ?> address:</small><br><input id=\"w_valid_ltc\" type='text' class='l' style='width: 100%;'><br><br><small>Enter amount to be paid-out:</small><br><input id=\"w_amount\" type='text' class='l' style='width: 100px; text-align: center;'><br><br><small><small>Min. value: <b><?php echo $settings['min_withdrawal']; ?></b> <?php echo $settings['currency_sign']; ?></small></small></div>",
        type:"info",
        opacity:0.8,
        buttons: [{ value: "Withdraw" }, { value: "Cancel" }],
        success: function(button) {
          if (button=="Withdraw" && withdrawing==false) {
            w_amount=$("input#w_amount").val();
            w_valid=$("input#w_valid_ltc").val();
            if (w_amount!='' && w_valid!='') {
              $("#_withdraw_content").html('<div style=\"height: 50px;\"></div>&nbsp;&nbsp;&nbsp;<img src="content/images/ajax_loader.gif">');
              withdrawing=true;
              _requestWithdraw(w_amount,w_valid);
            }
            else {
              alert('One of required fields stayed empty!');
            }
          }
        }
      });      
      return false;
    } 
    function passwd_protect() {
      pass=prompt('Password:');
      if (pass!=null && confirm('Your pasword: '+pass+'\nDo you really want to protect your URL with this password?')) {
        $.ajax({
          'url': './content/ajax/protect_url.php?_unique=<?php echo $unique; ?>&pass='+pass,
          'dataType': "json",
          'success': function(data) {
            alert('New password has been saved. Your unique URL is now password protected!');
            window.location.href='./';
          } 
        });
      }
    }
    function passwd_unprotect() {
      if (confirm('Do you really want to remove password protection from your unique URL?')) {
        $.ajax({
          'url': './content/ajax/unprotect_url.php?_unique=<?php echo $unique; ?>',
          'dataType': "json",
          'success': function(data) {
            alert('Your URL password protection has been successfuly removed!');
            window.location.href='./';
          } 
        });
      }
    }
    function _changeAlias(alias) {
      if (alias!=null && alias!='') {
        $.ajax({
          'url': './content/ajax/change_alias.php?alias='+alias+'&_unique=<?php echo $unique; ?>',
          'dataType': "json",
          'success': function(data) {
            if (data['error']=='no')
              $("#alias_sp").html(alias);
            else alert(data['content']);
          }
        });
      } else if (alias=='') alert('Invalid value!');
    }
    function tm_interval_content_(con) {
      $.ajax({
        'url': './content/ajax/_stats_load.php?con='+con+'&_unique=<?php echo $unique; ?>',
        'dataType': "json",
        'success': function(data) {
          $("#all.stats #content").html(data['content']);
          $("#content.stats_switcher a.current").removeClass('current');
          $("#content.stats_switcher a#_st_"+con).addClass('current');          
        }
      });
      if (con!='giveaway' && con!='chat' && con!='stats') timeout_=setTimeout("tm_interval_content_('"+con+"')",1000);
    }
    function _stats_content(con) {
      if (typeof(timeout_)!='undefined') {
        clearTimeout(timeout_);
      }
      tm_interval_content_(con);
    }
    var lastClaimed=(Date.now()-(<?php echo $settings['giveaway_freq']; ?>*1000)-1000);
    function claim(captcha) {
      if (lastClaimed<(Date.now()-(<?php echo $settings['giveaway_freq']; ?>*1000))) {
        $.ajax({
          'url': './content/ajax/claim.php?captcha='+captcha+'&_unique=<?php echo $unique; ?>',
          'dataType': "json",
          'success': function(data) {
            if (data['success']=='true') {
              _stats_content('giveaway');
              refreshBalance();
              lastClaimed=Date.now();            
            }
            else if (data['success']=='timenot') alert('Error: Minimal giveaway frequency is <?php echo $settings['giveaway_freq']; ?>s.');
            else alert('Invalid captcha!');
          }
        });
      }
      else alert('Error: Minimal giveaway frequency is <?php echo $settings['giveaway_freq']; ?>s.');      
    }
    function compose(m) {
      $.ajax({
        'url': './content/ajax/chat_post.php?con='+m+'&_unique=<?php echo $unique; ?>',
        'dataType': "json",
        'success': function(data) {
          if (data['success']==false) alert('You can\'t send more than 10 messages in a row.');
          else $("#composeTxt").val('');
          refreshChatWin();
        }
      });            
    }
    function refreshChatWin() {
      $.ajax({
        'url': './content/ajax/chat_get.php',
        'dataType': "json",
        'success': function(data) {
          $("#chatWindow").html(data['content']);
        }
      });          
    }
    function initializeRefreshingFrameChat() {
      refreshChatWin();
      setTimeout("initializeRefreshingFrameChat()",500);
    }
    function recountProfit() {
      var payout=parseFloat($("#betTb_multiplier").val());  
      var wager=parseFloat($("#bt_wager").val());
      $("#bt_profit").val(parseFloat((Math.round(((wager*payout)-wager)*1000000000)/1000000000).toFixed(9).toString().match(/^\d+(?:\.\d{0,8})?/)).toFixed(8));
    }
    function recountPayout() {
      var chance=parseFloat($("#betTb_chance").val()).toFixed(2);
      var house_edge=<?php echo $settings['house_edge']; ?>;
      var payout=(1/(chance/100)*((100-house_edge)/100));
      $("#betTb_multiplier").val(parseFloat(payout.toString().match(/^\d+(?:\.\d{0,2})?/)).toFixed(2));
      recountUnderOver();      
    }
    function recountPayout_bB() {
      var chance=parseFloat($("#betTb_chance_bB").val()).toFixed(2);
      var house_edge=<?php echo $settings['house_edge']; ?>;
      var payout=(1/(chance/100)*((100-house_edge)/100));
      $("#betTb_multiplier_bB").val(parseFloat(payout.toString().match(/^\d+(?:\.\d{0,2})?/)).toFixed(2));
      recountUnderOver_bB();      
    }
    function recountChance() {
      var payout=parseFloat($("#betTb_multiplier").val());
      var house_edge=<?php echo $settings['house_edge']; ?>;      
      var chance=(1/(payout/100)*((100-house_edge)/100));
      $("#betTb_chance").val(parseFloat((Math.round(chance*1000000000)/1000000000).toString().match(/^\d+(?:\.\d{0,2})?/)).toFixed(2));
      recountUnderOver();
    }
    function recountChance_bB() {
      var payout=parseFloat($("#betTb_multiplier_bB").val());
      var house_edge=<?php echo $settings['house_edge']; ?>;      
      var chance=(1/(payout/100)*((100-house_edge)/100));
      $("#betTb_chance_bB").val(parseFloat((Math.round(chance*1000000000)/1000000000).toString().match(/^\d+(?:\.\d{0,2})?/)).toFixed(2));
      recountUnderOver_bB();
    }
    function recountUnderOver() {
      if (under_over==true) var chance_=100-parseFloat($("#betTb_chance").val()).toFixed(2);
      else var chance_=parseFloat($("#betTb_chance").val()).toFixed(2);
      $("#under_over_num").html(parseFloat(chance_.toString().match(/^\d+(?:\.\d{0,2})?/)).toFixed(2));      
    }
    function recountUnderOver_bB() {
      if (under_over_bB==true) var chance_=100-parseFloat($("#betTb_chance_bB").val()).toFixed(2);
      else var chance_=parseFloat($("#betTb_chance_bB").val()).toFixed(2);
      $("#under_over_num_bB").html(parseFloat(chance_.toString().match(/^\d+(?:\.\d{0,2})?/)).toFixed(2));          
    }
    
    var bB_active=false;
    var onLoss=1;
    var onWin=0;
    var operateMode=0;
    var operateNum;
    var bB_profit=0;
    
    function bot_setPrefs() {
      $("#bt_wager").val(parseFloat($("#bt_wager_bB").val())).change();
      $("#betTb_multiplier").val(parseFloat($("#betTb_multiplier_bB").val())).change();
      if (under_over!=under_over_bB) inverse();    
    }
    function startAutomat() {
      if (bB_active==false) {
        bot_setPrefs();
        bB_active=true;
        operateNum=parseInt($("#bt_rolls_bB").val());
        if (operateMode==1) {
          $("#botBtn").html('TIME LEFT TO OPERATE: '+operateNum+'s');
          _interval=setInterval(function(){
            if (operateNum!=0) operateNum--;
            $("#botBtn").html('TIME LEFT TO OPERATE: '+operateNum+'s');
          },1000);
        }
        else $("#botBtn").html('ROLLS LEFT TO OPERATE: '+operateNum);
        $("#botBtn").qtip({
          content: {
            text: 'Click to stop betting'
          },
          style: {
            classes: 'qtip-bootstrap qtip-shadow'
          },
          position: {
            my: 'bottom center',
            at: 'top center'
          }
        });
        $("#botBtn").qtip("show");
        place($('#bt_wager').val(),$('#betTb_multiplier').val(),true);      
      }
      else {
        operateNum=0;
        bB_active=false;
        makeQtipFalse();
        $("#botBtn").html('CANCELLING');
        placed(0);
      }
    }
    function placed(win_or_lose) {
      if (bB_active==false || operateNum<1 || ($("#bB_max_loss").prop('checked')==true && bB_profit<=(0-parseFloat($("#bB_max_loss_val").val()))) || ($("#bB_max_win").prop('checked')==true && bB_profit>=parseFloat($("#bB_max_win_val").val()))) {
        if (typeof(_interval)!='undefined') clearInterval(_interval);
        bB_active=false;
        makeQtipFalse();
        $("#botBtn").html('START AUTOMATIC BETTING');
        bB_profit=0;
      }              
      else {
        if (win_or_lose==1) {     // WIN
          if (onWin==0) $("#bt_wager").val(parseFloat($("#bt_wager_bB").val())).change();            
          else $("#bt_wager").val((parseFloat($("#bt_wager").val())+((parseFloat($("#bt_wager").val())/100)*parseFloat($("#bB_win_increase_by").val())))).change();
        }
        else {                    // LOSS
          if (onLoss==0) $("#bt_wager").val(parseFloat($("#bt_wager_bB").val())).change();            
          else $("#bt_wager").val((parseFloat($("#bt_wager").val())+((parseFloat($("#bt_wager").val())/100)*parseFloat($("#bB_loss_increase_by").val())))).change();        
        }
        place($('#bt_wager').val(),$('#betTb_multiplier').val(),true);
      }
    }
    function makeQtipFalse() {
      $("#botBtn").qtip("destroy");
    }
</script>
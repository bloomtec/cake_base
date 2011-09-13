
var PageName = 'Home';
var PageId = '34f623b9ec9e40049d0255282e4b26eb'
var PageUrl = 'Home.html'
document.title = 'Home';
var PageNotes = 
{
"pageName":"Home",
"showNotesNames":"False"}
var $OnLoadVariable = '';

var $CSUM;

var hasQuery = false;
var query = window.location.hash.substring(1);
if (query.length > 0) hasQuery = true;
var vars = query.split("&");
for (var i = 0; i < vars.length; i++) {
    var pair = vars[i].split("=");
    if (pair[0].length > 0) eval("$" + pair[0] + " = decodeURIComponent(pair[1]);");
} 

if (hasQuery && $CSUM != 1) {
alert('Prototype Warning: The variable values were too long to pass to this page.\nIf you are using IE, using Firefox will support more data.');
}

function GetQuerystring() {
    return '#OnLoadVariable=' + encodeURIComponent($OnLoadVariable) + '&CSUM=1';
}

function PopulateVariables(value) {
    var d = new Date();
  value = value.replace(/\[\[OnLoadVariable\]\]/g, $OnLoadVariable);
  value = value.replace(/\[\[PageName\]\]/g, PageName);
  value = value.replace(/\[\[GenDay\]\]/g, '7');
  value = value.replace(/\[\[GenMonth\]\]/g, '9');
  value = value.replace(/\[\[GenMonthName\]\]/g, 'septiembre');
  value = value.replace(/\[\[GenDayOfWeek\]\]/g, 'miércoles');
  value = value.replace(/\[\[GenYear\]\]/g, '2011');
  value = value.replace(/\[\[Day\]\]/g, d.getDate());
  value = value.replace(/\[\[Month\]\]/g, d.getMonth() + 1);
  value = value.replace(/\[\[MonthName\]\]/g, GetMonthString(d.getMonth()));
  value = value.replace(/\[\[DayOfWeek\]\]/g, GetDayString(d.getDay()));
  value = value.replace(/\[\[Year\]\]/g, d.getFullYear());
  return value;
}

function OnLoad(e) {

}

widgetIdToHideFunction['u16'] = function() {
var e = windowEvent;

if (true) {

	MoveWidgetBy('u22',0,-17,'swing',500);

	MoveWidgetBy('u19',0,-17,'swing',500);

	MoveWidgetBy('u42',0,-17,'none',500);

	SetPanelVisibility('u52','hidden','none',500);

	SetPanelVisibility('u74','hidden','none',500);

	SetPanelVisibility('u77','hidden','none',500);

	SetPanelVisibility('u47','hidden','none',500);

	BringToFront("u98");

	BringToFront("u87");

	BringToFront("u130");

	BringToFront("u128");

	BringToFront("u132");

	BringToFront("u134");

}

}
widgetIdToHideFunction['u19'] = function() {
var e = windowEvent;

if (true) {

	MoveWidgetBy('u22',0,-17,'swing',500);

	MoveWidgetBy('u44',0,-30,'swing',500);

}

}
var u115 = document.getElementById('u115');

var u122 = document.getElementById('u122');

var u21 = document.getElementById('u21');
gv_vAlignTable['u21'] = 'center';
var u32 = document.getElementById('u32');

var u130 = document.getElementById('u130');

var u7 = document.getElementById('u7');

var u2 = document.getElementById('u2');

var u79 = document.getElementById('u79');
gv_vAlignTable['u79'] = 'center';
var u4 = document.getElementById('u4');
gv_vAlignTable['u4'] = 'center';
var u140 = document.getElementById('u140');
gv_vAlignTable['u140'] = 'center';
var u17 = document.getElementById('u17');

u17.style.cursor = 'pointer';
if (bIE) u17.attachEvent("onclick", Clicku17);
else u17.addEventListener("click", Clicku17, true);
function Clicku17(e)
{
windowEvent = e;


if (true) {

	SetPanelVisibility('u68','toggle','fade',500);

	SetPanelVisibility('u74','hidden','none',500);

	SetPanelVisibility('u47','hidden','none',500);

	SetPanelVisibility('u52','hidden','none',500);

	SetPanelVisibility('u77','hidden','fade',500);

	BringToFront("u98");

	BringToFront("u87");

	BringToFront("u68");

	BringToFront("u134");

	BringToFront("u132");

	BringToFront("u130");

	BringToFront("u128");

	BringToFront("u126");

	BringToFront("u124");

	BringToFront("u122");

	BringToFront("u136");

	SetPanelVisibility('u81','hidden','fade',500);

}

}

var u135 = document.getElementById('u135');

u135.style.cursor = 'pointer';
if (bIE) u135.attachEvent("onclick", Clicku135);
else u135.addEventListener("click", Clicku135, true);
function Clicku135(e)
{
windowEvent = e;


if (true) {

	MoveWidgetTo('u2', 275,0,'swing',500);

}

}

var u42 = document.getElementById('u42');

var u55 = document.getElementById('u55');

var u101 = document.getElementById('u101');

var u14 = document.getElementById('u14');

var u48 = document.getElementById('u48');

var u105 = document.getElementById('u105');

u105.style.cursor = 'pointer';
if (bIE) u105.attachEvent("onclick", Clicku105);
else u105.addEventListener("click", Clicku105, true);
function Clicku105(e)
{
windowEvent = e;


if (true) {

	SetPanelVisibility('u114','','fade',500);

}

}

var u27 = document.getElementById('u27');

var u138 = document.getElementById('u138');

var u52 = document.getElementById('u52');

var u20 = document.getElementById('u20');

u20.style.cursor = 'pointer';
if (bIE) u20.attachEvent("onclick", Clicku20);
else u20.addEventListener("click", Clicku20, true);
function Clicku20(e)
{
windowEvent = e;


if (true) {

	SetPanelVisibility('u68','toggle','fade',500);

	BringToFront("u68");

	BringToFront("u98");

	BringToFront("u87");

	BringToFront("u128");

	BringToFront("u132");

	BringToFront("u134");

	BringToFront("u130");

	BringToFront("u126");

	BringToFront("u124");

	BringToFront("u122");

	BringToFront("u136");

	SetPanelVisibility('u52','hidden','none',500);

	SetPanelVisibility('u77','hidden','none',500);

	SetPanelVisibility('u74','hidden','none',500);

	SetPanelVisibility('u81','hidden','fade',500);

}

}

var u67 = document.getElementById('u67');

u67.style.cursor = 'pointer';
if (bIE) u67.attachEvent("onclick", Clicku67);
else u67.addEventListener("click", Clicku67, true);
function Clicku67(e)
{
windowEvent = e;


if (true) {

	SetPanelVisibility('u63','','fade',500);

}

}

var u65 = document.getElementById('u65');
gv_vAlignTable['u65'] = 'center';
var u120 = document.getElementById('u120');
gv_vAlignTable['u120'] = 'center';
var u110 = document.getElementById('u110');

var u6 = document.getElementById('u6');
gv_vAlignTable['u6'] = 'center';
var u108 = document.getElementById('u108');
gv_vAlignTable['u108'] = 'center';
var u37 = document.getElementById('u37');

var u62 = document.getElementById('u62');

u62.style.cursor = 'pointer';
if (bIE) u62.attachEvent("onclick", Clicku62);
else u62.addEventListener("click", Clicku62, true);
function Clicku62(e)
{
windowEvent = e;


if (true) {

	SetPanelVisibility('u58','','fade',500);

}

}

var u141 = document.getElementById('u141');

var u11 = document.getElementById('u11');

var u75 = document.getElementById('u75');

var u133 = document.getElementById('u133');

u133.style.cursor = 'pointer';
if (bIE) u133.attachEvent("onclick", Clicku133);
else u133.addEventListener("click", Clicku133, true);
function Clicku133(e)
{
windowEvent = e;


if (true) {

	MoveWidgetTo('u11', 275,0,'swing',500);

}

}

var u34 = document.getElementById('u34');

var u68 = document.getElementById('u68');

var u89 = document.getElementById('u89');
gv_vAlignTable['u89'] = 'center';
var u39 = document.getElementById('u39');
gv_vAlignTable['u39'] = 'center';
var u47 = document.getElementById('u47');

var u72 = document.getElementById('u72');

var u103 = document.getElementById('u103');

u103.style.cursor = 'pointer';
if (bIE) u103.attachEvent("onclick", Clicku103);
else u103.addEventListener("click", Clicku103, true);
function Clicku103(e)
{
windowEvent = e;


if (true) {

	SetPanelVisibility('u114','hidden','fade',500);

}

}

var u99 = document.getElementById('u99');

var u66 = document.getElementById('u66');

u66.style.cursor = 'pointer';
if (bIE) u66.attachEvent("onclick", Clicku66);
else u66.addEventListener("click", Clicku66, true);
function Clicku66(e)
{
windowEvent = e;


if (true) {

	SetPanelVisibility('u63','hidden','fade',500);

}

}

var u112 = document.getElementById('u112');

u112.style.cursor = 'pointer';
if (bIE) u112.attachEvent("onclick", Clicku112);
else u112.addEventListener("click", Clicku112, true);
function Clicku112(e)
{
windowEvent = e;


if (true) {

	SetPanelVisibility('u109','hidden','fade',500);

}

}

var u44 = document.getElementById('u44');

var u78 = document.getElementById('u78');

var u57 = document.getElementById('u57');

var u119 = document.getElementById('u119');

var u16 = document.getElementById('u16');

var u125 = document.getElementById('u125');

u125.style.cursor = 'pointer';
if (bIE) u125.attachEvent("onclick", Clicku125);
else u125.addEventListener("click", Clicku125, true);
function Clicku125(e)
{
windowEvent = e;


if (true) {

	MoveWidgetTo('u11', 1230,0,'swing',500);

}

}

var u41 = document.getElementById('u41');

u41.style.cursor = 'pointer';
if (bIE) u41.attachEvent("onclick", Clicku41);
else u41.addEventListener("click", Clicku41, true);
function Clicku41(e)
{
windowEvent = e;


if (true) {

	SetPanelVisibility('u16','hidden','fade',500);

}

}

var u54 = document.getElementById('u54');
gv_vAlignTable['u54'] = 'center';
var u118 = document.getElementById('u118');

var u88 = document.getElementById('u88');

var u38 = document.getElementById('u38');

var u26 = document.getElementById('u26');
gv_vAlignTable['u26'] = 'center';
var u128 = document.getElementById('u128');

var u85 = document.getElementById('u85');
gv_vAlignTable['u85'] = 'center';
var u51 = document.getElementById('u51');

u51.style.cursor = 'pointer';
if (bIE) u51.attachEvent("onclick", Clicku51);
else u51.addEventListener("click", Clicku51, true);
function Clicku51(e)
{
windowEvent = e;


if (true) {

	SetPanelVisibility('u138','','fade',500);

	BringToFront("u138");

}

}

var u10 = document.getElementById('u10');
gv_vAlignTable['u10'] = 'top';
var u100 = document.getElementById('u100');
gv_vAlignTable['u100'] = 'center';
var u23 = document.getElementById('u23');

u23.style.cursor = 'pointer';
if (bIE) u23.attachEvent("onclick", Clicku23);
else u23.addEventListener("click", Clicku23, true);
function Clicku23(e)
{
windowEvent = e;


if (true) {

	SetPanelVisibility('u68','toggle','fade',500);

	SetPanelVisibility('u74','hidden','none',500);

	SetPanelVisibility('u47','hidden','none',500);

	SetPanelVisibility('u52','hidden','none',500);

	SetPanelVisibility('u77','hidden','fade',500);

	BringToFront("u98");

	BringToFront("u87");

	BringToFront("u68");

	BringToFront("u134");

	BringToFront("u132");

	BringToFront("u130");

	BringToFront("u128");

	BringToFront("u126");

	BringToFront("u124");

	BringToFront("u122");

	BringToFront("u136");

	SetPanelVisibility('u81','hidden','fade',500);

}

}

var u144 = document.getElementById('u144');
gv_vAlignTable['u144'] = 'top';
var u82 = document.getElementById('u82');

var u36 = document.getElementById('u36');
gv_vAlignTable['u36'] = 'center';
var u30 = document.getElementById('u30');
gv_vAlignTable['u30'] = 'center';
var u95 = document.getElementById('u95');
gv_vAlignTable['u95'] = 'center';
var u61 = document.getElementById('u61');

u61.style.cursor = 'pointer';
if (bIE) u61.attachEvent("onclick", Clicku61);
else u61.addEventListener("click", Clicku61, true);
function Clicku61(e)
{
windowEvent = e;


if (true) {

	SetPanelVisibility('u58','hidden','fade',500);

}

}

var u116 = document.getElementById('u116');
gv_vAlignTable['u116'] = 'center';
var u74 = document.getElementById('u74');

var u123 = document.getElementById('u123');

u123.style.cursor = 'pointer';
if (bIE) u123.attachEvent("onclick", Clicku123);
else u123.addEventListener("click", Clicku123, true);
function Clicku123(e)
{
windowEvent = e;


if (true) {

	MoveWidgetTo('u87', 1230,0,'swing',500);

}

}

var u114 = document.getElementById('u114');

var u33 = document.getElementById('u33');
gv_vAlignTable['u33'] = 'center';
var u92 = document.getElementById('u92');

var u46 = document.getElementById('u46');

u46.style.cursor = 'pointer';
if (bIE) u46.attachEvent("onclick", Clicku46);
else u46.addEventListener("click", Clicku46, true);
function Clicku46(e)
{
windowEvent = e;


if (true) {

	SetPanelVisibility('u74','','none',500);

	SetPanelVisibility('u52','','fade',500);

	BringToFront("u52");

	BringToFront("u98");

	BringToFront("u87");

	BringToFront("u128");

	BringToFront("u130");

	BringToFront("u132");

	BringToFront("u134");

	BringToFront("u126");

	BringToFront("u124");

	BringToFront("u122");

	SetPanelVisibility('u77','hidden','fade',500);

	SetPanelVisibility('u81','','fade',500);

}

}

var u126 = document.getElementById('u126');

var u71 = document.getElementById('u71');

var u5 = document.getElementById('u5');

var u98 = document.getElementById('u98');

var u127 = document.getElementById('u127');

u127.style.cursor = 'pointer';
if (bIE) u127.attachEvent("onclick", Clicku127);
else u127.addEventListener("click", Clicku127, true);
function Clicku127(e)
{
windowEvent = e;


if (true) {

	MoveWidgetTo('u2', 1230,0,'swing',500);

}

}

var u43 = document.getElementById('u43');

u43.style.cursor = 'pointer';
if (bIE) u43.attachEvent("onclick", Clicku43);
else u43.addEventListener("click", Clicku43, true);
function Clicku43(e)
{
windowEvent = e;


if (true) {

	SetPanelVisibility('u19','hidden','fade',500);

}

}

var u56 = document.getElementById('u56');

var u142 = document.getElementById('u142');
gv_vAlignTable['u142'] = 'center';
var u106 = document.getElementById('u106');
gv_vAlignTable['u106'] = 'top';
var u40 = document.getElementById('u40');

var u139 = document.getElementById('u139');

var u87 = document.getElementById('u87');

var u53 = document.getElementById('u53');

var u104 = document.getElementById('u104');
gv_vAlignTable['u104'] = 'top';
var u121 = document.getElementById('u121');

u121.style.cursor = 'pointer';
if (bIE) u121.attachEvent("onclick", Clicku121);
else u121.addEventListener("click", Clicku121, true);
function Clicku121(e)
{
windowEvent = e;


if (true) {

	SetPanelVisibility('u118','hidden','fade',500);

}

}

var u19 = document.getElementById('u19');

var u109 = document.getElementById('u109');

var u84 = document.getElementById('u84');

var u50 = document.getElementById('u50');

var u97 = document.getElementById('u97');

var u63 = document.getElementById('u63');

var u76 = document.getElementById('u76');
gv_vAlignTable['u76'] = 'center';
var u134 = document.getElementById('u134');

var u81 = document.getElementById('u81');

var u94 = document.getElementById('u94');

var u60 = document.getElementById('u60');
gv_vAlignTable['u60'] = 'center';
var u102 = document.getElementById('u102');
gv_vAlignTable['u102'] = 'center';
var u9 = document.getElementById('u9');
gv_vAlignTable['u9'] = 'center';
var u73 = document.getElementById('u73');

var u69 = document.getElementById('u69');

var u91 = document.getElementById('u91');
gv_vAlignTable['u91'] = 'center';
var u131 = document.getElementById('u131');

u131.style.cursor = 'pointer';
if (bIE) u131.attachEvent("onclick", Clicku131);
else u131.addEventListener("click", Clicku131, true);
function Clicku131(e)
{
windowEvent = e;


if (true) {

	MoveWidgetTo('u98', 275,0,'swing',500);

}

}

var u64 = document.getElementById('u64');

var u70 = document.getElementById('u70');
gv_vAlignTable['u70'] = 'center';
var u24 = document.getElementById('u24');
gv_vAlignTable['u24'] = 'center';
var u117 = document.getElementById('u117');

u117.style.cursor = 'pointer';
if (bIE) u117.attachEvent("onclick", Clicku117);
else u117.addEventListener("click", Clicku117, true);
function Clicku117(e)
{
windowEvent = e;


if (true) {

	SetPanelVisibility('u118','','fade',500);

}

}

var u13 = document.getElementById('u13');
gv_vAlignTable['u13'] = 'center';
var u113 = document.getElementById('u113');

u113.style.cursor = 'pointer';
if (bIE) u113.attachEvent("onclick", Clicku113);
else u113.addEventListener("click", Clicku113, true);
function Clicku113(e)
{
windowEvent = e;


if (true) {

	SetPanelVisibility('u109','','fade',500);

}

}

var u29 = document.getElementById('u29');

var u132 = document.getElementById('u132');

var u129 = document.getElementById('u129');

u129.style.cursor = 'pointer';
if (bIE) u129.attachEvent("onclick", Clicku129);
else u129.addEventListener("click", Clicku129, true);
function Clicku129(e)
{
windowEvent = e;


if (true) {

	MoveWidgetTo('u87', 275,0,'swing',500);

}

}

var u86 = document.getElementById('u86');
gv_vAlignTable['u86'] = 'top';
var u58 = document.getElementById('u58');

var u111 = document.getElementById('u111');
gv_vAlignTable['u111'] = 'center';
var u0 = document.getElementById('u0');

var u31 = document.getElementById('u31');

var u83 = document.getElementById('u83');
gv_vAlignTable['u83'] = 'center';
var u8 = document.getElementById('u8');

var u3 = document.getElementById('u3');

var u96 = document.getElementById('u96');

u96.style.cursor = 'pointer';
if (bIE) u96.attachEvent("onclick", Clicku96);
else u96.addEventListener("click", Clicku96, true);
function Clicku96(e)
{
windowEvent = e;


if (true) {

	SetPanelVisibility('u93','','fade',500);

}

}

var u15 = document.getElementById('u15');
gv_vAlignTable['u15'] = 'center';
var u49 = document.getElementById('u49');
gv_vAlignTable['u49'] = 'center';
var u124 = document.getElementById('u124');

var u80 = document.getElementById('u80');

u80.style.cursor = 'pointer';
if (bIE) u80.attachEvent("onclick", Clicku80);
else u80.addEventListener("click", Clicku80, true);
function Clicku80(e)
{
windowEvent = e;


if (true) {

	SetPanelVisibility('u77','','fade',500);

	SetPanelVisibility('u47','','fade',500);

	BringToFront("u77");

	BringToFront("u47");

	BringToFront("u87");

	BringToFront("u98");

	BringToFront("u128");

	BringToFront("u132");

	BringToFront("u134");

	BringToFront("u130");

	BringToFront("u122");

	BringToFront("u126");

	BringToFront("u124");

	BringToFront("u136");

	SetPanelVisibility('u74','hidden','fade',500);

	SetPanelVisibility('u52','hidden','fade',500);

	SetPanelVisibility('u81','','fade',500);

}

}

var u1 = document.getElementById('u1');
gv_vAlignTable['u1'] = 'center';
var u93 = document.getElementById('u93');

var u145 = document.getElementById('u145');

u145.style.cursor = 'pointer';
if (bIE) u145.attachEvent("onclick", Clicku145);
else u145.addEventListener("click", Clicku145, true);
function Clicku145(e)
{
windowEvent = e;


if (true) {

	SetPanelVisibility('u138','hidden','fade',500);

}

}

var u12 = document.getElementById('u12');

var u25 = document.getElementById('u25');

var u59 = document.getElementById('u59');

var u137 = document.getElementById('u137');

u137.style.cursor = 'pointer';
if (bIE) u137.attachEvent("onclick", Clicku137);
else u137.addEventListener("click", Clicku137, true);
function Clicku137(e)
{
windowEvent = e;


if (true) {

	MoveWidgetTo('u98', 1230,0,'swing',500);

}

}

var u90 = document.getElementById('u90');

var u18 = document.getElementById('u18');
gv_vAlignTable['u18'] = 'center';
var u45 = document.getElementById('u45');

u45.style.cursor = 'pointer';
if (bIE) u45.attachEvent("onclick", Clicku45);
else u45.addEventListener("click", Clicku45, true);
function Clicku45(e)
{
windowEvent = e;


if (true) {

	SetPanelVisibility('u22','hidden','fade',500);

}

}

var u77 = document.getElementById('u77');

var u22 = document.getElementById('u22');

var u143 = document.getElementById('u143');
gv_vAlignTable['u143'] = 'top';
var u107 = document.getElementById('u107');

var u35 = document.getElementById('u35');

var u136 = document.getElementById('u136');

var u28 = document.getElementById('u28');

if (window.OnLoad) OnLoad();

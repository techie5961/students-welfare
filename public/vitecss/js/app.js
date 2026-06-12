
// ============================================
// HAMMER.JS v2.0.7 + EASY GESTURE WRAPPER
// With Scroll Prevention & Position Data
// ============================================
//
// 📖 HOW TO USE WITH POSITION DATA:
// ============================================
//
// 1. Include this file in your HTML:
//    <script src="gesture.js"></script>
//
// 2. Get any HTML element:
//    const myElement = document.getElementById('myBox');
//
// 3. ALL callbacks receive an event object with position data:
//
//    // SWIPE EXAMPLES - event object contains:
//    Gesture.left(myElement, (event) => {
//        console.log('Center X:', event.center.x);      // Current X position
//        console.log('Center Y:', event.center.y);      // Current Y position
//        console.log('Delta X:', event.deltaX);         // Distance moved X
//        console.log('Delta Y:', event.deltaY);         // Distance moved Y
//        console.log('Velocity:', event.velocity);      // Speed of swipe
//        console.log('Direction:', event.direction);    // Which direction
//        console.log('Target:', event.target);          // DOM element
//        console.log('Time:', event.timeStamp);         // Timestamp
//    });
//
//    // Same for right, up, down, and swipe:
//    Gesture.right(myElement, (event) => {
//        console.log('Position:', event.center.x, event.center.y);
//    });
//
//    // LONG PRESS - also returns position data:
//    Gesture.hold(myElement, (event) => {
//        console.log('Press position X:', event.center.x);
//        console.log('Press position Y:', event.center.y);
//        console.log('Target element:', event.target);
//    });
//
//    // ANY SWIPE - get direction + position:
//    Gesture.swipe(myElement, (event) => {
//        console.log('Swipe type:', event.type);        // swipeleft, swiperight, etc.
//        console.log('Start X:', event.center.x);
//        console.log('Start Y:', event.center.y);
//        console.log('Distance:', event.distance);
//    });
//
// ============================================
// 📝 COMPLETE EVENT PROPERTIES:
// ============================================
//
// event.center      - { x, y } current center position
// event.deltaX      - X distance moved since start
// event.deltaY      - Y distance moved since start
// event.deltaTime   - Time elapsed since start (ms)
// event.distance    - Total distance moved
// event.direction   - Direction constant (1=left, 2=right, 4=up, 8=down)
// event.velocity    - Current velocity
// event.velocityX   - X velocity
// event.velocityY   - Y velocity
// event.target      - The DOM element that received the gesture
// event.srcEvent    - Original browser event
// event.timeStamp   - Timestamp of the event
// event.type        - Event name (swipeleft, swiperight, etc.)
// event.pointerType - 'touch', 'mouse', or 'pen'
//
// ============================================
// 📝 COMPLETE EXAMPLE WITH POSITIONS:
// ============================================
//
// <div id="myBox" style="width:300px;height:300px;background:blue;">
//   Swipe Me
// </div>
// <div id="coords">Position: </div>
//
// <script>
//   const box = document.getElementById('myBox');
//   const coords = document.getElementById('coords');
//   
//   // Show live position on any swipe
//   Gesture.swipe(box, (event) => {
//       coords.innerHTML = `Position: X=${Math.round(event.center.x)}, Y=${Math.round(event.center.y)}`;
//   });
//   
//   // Different actions per direction
//   Gesture.left(box, (event) => {
//       console.log(`Swiped left from X=${event.center.x}`);
//       box.style.background = 'red';
//   });
//   
//   Gesture.right(box, (event) => {
//       console.log(`Swiped right from X=${event.center.x}`);
//       box.style.background = 'green';
//   });
//   
//   Gesture.hold(box, (event) => {
//       console.log(`Long pressed at X=${event.center.x}, Y=${event.center.y}`);
//       box.style.background = 'purple';
//   });
// </script>
//
// ============================================
// ⚠️ IMPORTANT CSS:
// ============================================
//
// .my-gesture-element {
//     touch-action: none;  /* Prevents browser scroll/pinch */
//     user-select: none;   /* Prevents text selection while swiping */
// }
//
// ============================================
// 🎯 AVAILABLE METHODS:
// ============================================
//
// Gesture.left(element, callback)    - Swipe left (callback gets event with position)
// Gesture.right(element, callback)   - Swipe right (callback gets event with position)
// Gesture.up(element, callback)      - Swipe up (callback gets event with position)
// Gesture.down(element, callback)    - Swipe down (callback gets event with position)
// Gesture.hold(element, callback)    - Long press (callback gets event with position)
// Gesture.swipe(element, callback)   - Any swipe (callback gets event with position)
// Gesture.off(element, event, fn)    - Remove event listener
// Gesture.destroy(element)           - Remove all gestures
//
// ============================================
// END OF INSTRUCTIONS
// ============================================

// Hammer.js (minified)
!function(a,b,c,d){"use strict";function e(a,b,c){return setTimeout(j(a,c),b)}function f(a,b,c){return Array.isArray(a)?(g(a,c[b],c),!0):!1}function g(a,b,c){var e;if(a)if(a.forEach)a.forEach(b,c);else if(a.length!==d)for(e=0;e<a.length;)b.call(c,a[e],e,a),e++;else for(e in a)a.hasOwnProperty(e)&&b.call(c,a[e],e,a)}function h(b,c,d){var e="DEPRECATED METHOD: "+c+"\n"+d+" AT \n";return function(){var c=new Error("get-stack-trace"),d=c&&c.stack?c.stack.replace(/^[^\(]+?[\n$]/gm,"").replace(/^\s+at\s+/gm,"").replace(/^Object.<anonymous>\s*\(/gm,"{anonymous}()@"):"Unknown Stack Trace",f=a.console&&(a.console.warn||a.console.log);return f&&f.call(a.console,e,d),b.apply(this,arguments)}}function i(a,b,c){var d,e=b.prototype;d=a.prototype=Object.create(e),d.constructor=a,d._super=e,c&&la(d,c)}function j(a,b){return function(){return a.apply(b,arguments)}}function k(a,b){return typeof a==oa?a.apply(b?b[0]||d:d,b):a}function l(a,b){return a===d?b:a}function m(a,b,c){g(q(b),function(b){a.addEventListener(b,c,!1)})}function n(a,b,c){g(q(b),function(b){a.removeEventListener(b,c,!1)})}function o(a,b){for(;a;){if(a==b)return!0;a=a.parentNode}return!1}function p(a,b){return a.indexOf(b)>-1}function q(a){return a.trim().split(/\s+/g)}function r(a,b,c){if(a.indexOf&&!c)return a.indexOf(b);for(var d=0;d<a.length;){if(c&&a[d][c]==b||!c&&a[d]===b)return d;d++}return-1}function s(a){return Array.prototype.slice.call(a,0)}function t(a,b,c){for(var d=[],e=[],f=0;f<a.length;){var g=b?a[f][b]:a[f];r(e,g)<0&&d.push(a[f]),e[f]=g,f++}return c&&(d=b?d.sort(function(a,c){return a[b]>c[b]}):d.sort()),d}function u(a,b){for(var c,e,f=b[0].toUpperCase()+b.slice(1),g=0;g<ma.length;){if(c=ma[g],e=c?c+f:b,e in a)return e;g++}return d}function v(){return ua++}function w(b){var c=b.ownerDocument||b;return c.defaultView||c.parentWindow||a}function x(a,b){var c=this;this.manager=a,this.callback=b,this.element=a.element,this.target=a.options.inputTarget,this.domHandler=function(b){k(a.options.enable,[a])&&c.handler(b)},this.init()}function y(a){var b,c=a.options.inputClass;return new(b=c?c:xa?M:ya?P:wa?R:L)(a,z)}function z(a,b,c){var d=c.pointers.length,e=c.changedPointers.length,f=b&Ea&&d-e===0,g=b&(Ga|Ha)&&d-e===0;c.isFirst=!!f,c.isFinal=!!g,f&&(a.session={}),c.eventType=b,A(a,c),a.emit("hammer.input",c),a.recognize(c),a.session.prevInput=c}function A(a,b){var c=a.session,d=b.pointers,e=d.length;c.firstInput||(c.firstInput=D(b)),e>1&&!c.firstMultiple?c.firstMultiple=D(b):1===e&&(c.firstMultiple=!1);var f=c.firstInput,g=c.firstMultiple,h=g?g.center:f.center,i=b.center=E(d);b.timeStamp=ra(),b.deltaTime=b.timeStamp-f.timeStamp,b.angle=I(h,i),b.distance=H(h,i),B(c,b),b.offsetDirection=G(b.deltaX,b.deltaY);var j=F(b.deltaTime,b.deltaX,b.deltaY);b.overallVelocityX=j.x,b.overallVelocityY=j.y,b.overallVelocity=qa(j.x)>qa(j.y)?j.x:j.y,b.scale=g?K(g.pointers,d):1,b.rotation=g?J(g.pointers,d):0,b.maxPointers=c.prevInput?b.pointers.length>c.prevInput.maxPointers?b.pointers.length:c.prevInput.maxPointers:b.pointers.length,C(c,b);var k=a.element;o(b.srcEvent.target,k)&&(k=b.srcEvent.target),b.target=k}function B(a,b){var c=b.center,d=a.offsetDelta||{},e=a.prevDelta||{},f=a.prevInput||{};b.eventType!==Ea&&f.eventType!==Ga||(e=a.prevDelta={x:f.deltaX||0,y:f.deltaY||0},d=a.offsetDelta={x:c.x,y:c.y}),b.deltaX=e.x+(c.x-d.x),b.deltaY=e.y+(c.y-d.y)}function C(a,b){var c,e,f,g,h=a.lastInterval||b,i=b.timeStamp-h.timeStamp;if(b.eventType!=Ha&&(i>Da||h.velocity===d)){var j=b.deltaX-h.deltaX,k=b.deltaY-h.deltaY,l=F(i,j,k);e=l.x,f=l.y,c=qa(l.x)>qa(l.y)?l.x:l.y,g=G(j,k),a.lastInterval=b}else c=h.velocity,e=h.velocityX,f=h.velocityY,g=h.direction;b.velocity=c,b.velocityX=e,b.velocityY=f,b.direction=g}function D(a){for(var b=[],c=0;c<a.pointers.length;)b[c]={clientX:pa(a.pointers[c].clientX),clientY:pa(a.pointers[c].clientY)},c++;return{timeStamp:ra(),pointers:b,center:E(b),deltaX:a.deltaX,deltaY:a.deltaY}}function E(a){var b=a.length;if(1===b)return{x:pa(a[0].clientX),y:pa(a[0].clientY)};for(var c=0,d=0,e=0;b>e;)c+=a[e].clientX,d+=a[e].clientY,e++;return{x:pa(c/b),y:pa(d/b)}}function F(a,b,c){return{x:b/a||0,y:c/a||0}}function G(a,b){return a===b?Ia:qa(a)>=qa(b)?0>a?Ja:Ka:0>b?La:Ma}function H(a,b,c){c||(c=Qa);var d=b[c[0]]-a[c[0]],e=b[c[1]]-a[c[1]];return Math.sqrt(d*d+e*e)}function I(a,b,c){c||(c=Qa);var d=b[c[0]]-a[c[0]],e=b[c[1]]-a[c[1]];return 180*Math.atan2(e,d)/Math.PI}function J(a,b){return I(b[1],b[0],Ra)+I(a[1],a[0],Ra)}function K(a,b){return H(b[0],b[1],Ra)/H(a[0],a[1],Ra)}function L(){this.evEl=Ta,this.evWin=Ua,this.pressed=!1,x.apply(this,arguments)}function M(){this.evEl=Xa,this.evWin=Ya,x.apply(this,arguments),this.store=this.manager.session.pointerEvents=[]}function N(){this.evTarget=$a,this.evWin=_a,this.started=!1,x.apply(this,arguments)}function O(a,b){var c=s(a.touches),d=s(a.changedTouches);return b&(Ga|Ha)&&(c=t(c.concat(d),"identifier",!0)),[c,d]}function P(){this.evTarget=bb,this.targetIds={},x.apply(this,arguments)}function Q(a,b){var c=s(a.touches),d=this.targetIds;if(b&(Ea|Fa)&&1===c.length)return d[c[0].identifier]=!0,[c,c];var e,f,g=s(a.changedTouches),h=[],i=this.target;if(f=c.filter(function(a){return o(a.target,i)}),b===Ea)for(e=0;e<f.length;)d[f[e].identifier]=!0,e++;for(e=0;e<g.length;)d[g[e].identifier]&&h.push(g[e]),b&(Ga|Ha)&&delete d[g[e].identifier],e++;return h.length?[t(f.concat(h),"identifier",!0),h]:void 0}function R(){x.apply(this,arguments);var a=j(this.handler,this);this.touch=new P(this.manager,a),this.mouse=new L(this.manager,a),this.primaryTouch=null,this.lastTouches=[]}function S(a,b){a&Ea?(this.primaryTouch=b.changedPointers[0].identifier,T.call(this,b)):a&(Ga|Ha)&&T.call(this,b)}function T(a){var b=a.changedPointers[0];if(b.identifier===this.primaryTouch){var c={x:b.clientX,y:b.clientY};this.lastTouches.push(c);var d=this.lastTouches,e=function(){var a=d.indexOf(c);a>-1&&d.splice(a,1)};setTimeout(e,cb)}}function U(a){for(var b=a.srcEvent.clientX,c=a.srcEvent.clientY,d=0;d<this.lastTouches.length;d++){var e=this.lastTouches[d],f=Math.abs(b-e.x),g=Math.abs(c-e.y);if(db>=f&&db>=g)return!0}return!1}function V(a,b){this.manager=a,this.set(b)}function W(a){if(p(a,jb))return jb;var b=p(a,kb),c=p(a,lb);return b&&c?jb:b||c?b?kb:lb:p(a,ib)?ib:hb}function X(){if(!fb)return!1;var b={},c=a.CSS&&a.CSS.supports;return["auto","manipulation","pan-y","pan-x","pan-x pan-y","none"].forEach(function(d){b[d]=c?a.CSS.supports("touch-action",d):!0}),b}function Y(a){this.options=la({},this.defaults,a||{}),this.id=v(),this.manager=null,this.options.enable=l(this.options.enable,!0),this.state=nb,this.simultaneous={},this.requireFail=[]}function Z(a){return a&sb?"cancel":a&qb?"end":a&pb?"move":a&ob?"start":""}function $(a){return a==Ma?"down":a==La?"up":a==Ja?"left":a==Ka?"right":""}function _(a,b){var c=b.manager;return c?c.get(a):a}function aa(){Y.apply(this,arguments)}function ba(){aa.apply(this,arguments),this.pX=null,this.pY=null}function ca(){aa.apply(this,arguments)}function da(){Y.apply(this,arguments),this._timer=null,this._input=null}function ea(){aa.apply(this,arguments)}function fa(){aa.apply(this,arguments)}function ga(){Y.apply(this,arguments),this.pTime=!1,this.pCenter=!1,this._timer=null,this._input=null,this.count=0}function ha(a,b){return b=b||{},b.recognizers=l(b.recognizers,ha.defaults.preset),new ia(a,b)}function ia(a,b){this.options=la({},ha.defaults,b||{}),this.options.inputTarget=this.options.inputTarget||a,this.handlers={},this.session={},this.recognizers=[],this.oldCssProps={},this.element=a,this.input=y(this),this.touchAction=new V(this,this.options.touchAction),ja(this,!0),g(this.options.recognizers,function(a){var b=this.add(new a[0](a[1]));a[2]&&b.recognizeWith(a[2]),a[3]&&b.requireFailure(a[3])},this)}function ja(a,b){var c=a.element;if(c.style){var d;g(a.options.cssProps,function(e,f){d=u(c.style,f),b?(a.oldCssProps[d]=c.style[d],c.style[d]=e):c.style[d]=a.oldCssProps[d]||""}),b||(a.oldCssProps={})}}function ka(a,c){var d=b.createEvent("Event");d.initEvent(a,!0,!0),d.gesture=c,c.target.dispatchEvent(d)}var la,ma=["","webkit","Moz","MS","ms","o"],na=b.createElement("div"),oa="function",pa=Math.round,qa=Math.abs,ra=Date.now;la="function"!=typeof Object.assign?function(a){if(a===d||null===a)throw new TypeError("Cannot convert undefined or null to object");for(var b=Object(a),c=1;c<arguments.length;c++){var e=arguments[c];if(e!==d&&null!==e)for(var f in e)e.hasOwnProperty(f)&&(b[f]=e[f])}return b}:Object.assign;var sa=h(function(a,b,c){for(var e=Object.keys(b),f=0;f<e.length;)(!c||c&&a[e[f]]===d)&&(a[e[f]]=b[e[f]]),f++;return a},"extend","Use `assign`."),ta=h(function(a,b){return sa(a,b,!0)},"merge","Use `assign`."),ua=1,va=/mobile|tablet|ip(ad|hone|od)|android/i,wa="ontouchstart"in a,xa=u(a,"PointerEvent")!==d,ya=wa&&va.test(navigator.userAgent),za="touch",Aa="pen",Ba="mouse",Ca="kinect",Da=25,Ea=1,Fa=2,Ga=4,Ha=8,Ia=1,Ja=2,Ka=4,La=8,Ma=16,Na=Ja|Ka,Oa=La|Ma,Pa=Na|Oa,Qa=["x","y"],Ra=["clientX","clientY"];x.prototype={handler:function(){},init:function(){this.evEl&&m(this.element,this.evEl,this.domHandler),this.evTarget&&m(this.target,this.evTarget,this.domHandler),this.evWin&&m(w(this.element),this.evWin,this.domHandler)},destroy:function(){this.evEl&&n(this.element,this.evEl,this.domHandler),this.evTarget&&n(this.target,this.evTarget,this.domHandler),this.evWin&&n(w(this.element),this.evWin,this.domHandler)}};var Sa={mousedown:Ea,mousemove:Fa,mouseup:Ga},Ta="mousedown",Ua="mousemove mouseup";i(L,x,{handler:function(a){var b=Sa[a.type];b&Ea&&0===a.button&&(this.pressed=!0),b&Fa&&1!==a.which&&(b=Ga),this.pressed&&(b&Ga&&(this.pressed=!1),this.callback(this.manager,b,{pointers:[a],changedPointers:[a],pointerType:Ba,srcEvent:a}))}});var Va={pointerdown:Ea,pointermove:Fa,pointerup:Ga,pointercancel:Ha,pointerout:Ha},Wa={2:za,3:Aa,4:Ba,5:Ca},Xa="pointerdown",Ya="pointermove pointerup pointercancel";a.MSPointerEvent&&!a.PointerEvent&&(Xa="MSPointerDown",Ya="MSPointerMove MSPointerUp MSPointerCancel"),i(M,x,{handler:function(a){var b=this.store,c=!1,d=a.type.toLowerCase().replace("ms",""),e=Va[d],f=Wa[a.pointerType]||a.pointerType,g=f==za,h=r(b,a.pointerId,"pointerId");e&Ea&&(0===a.button||g)?0>h&&(b.push(a),h=b.length-1):e&(Ga|Ha)&&(c=!0),0>h||(b[h]=a,this.callback(this.manager,e,{pointers:b,changedPointers:[a],pointerType:f,srcEvent:a}),c&&b.splice(h,1))}});var Za={touchstart:Ea,touchmove:Fa,touchend:Ga,touchcancel:Ha},$a="touchstart",_a="touchstart touchmove touchend touchcancel";i(N,x,{handler:function(a){var b=Za[a.type];if(b===Ea&&(this.started=!0),this.started){var c=O.call(this,a,b);b&(Ga|Ha)&&c[0].length-c[1].length===0&&(this.started=!1),this.callback(this.manager,b,{pointers:c[0],changedPointers:c[1],pointerType:za,srcEvent:a})}}});var ab={touchstart:Ea,touchmove:Fa,touchend:Ga,touchcancel:Ha},bb="touchstart touchmove touchend touchcancel";i(P,x,{handler:function(a){var b=ab[a.type],c=Q.call(this,a,b);c&&this.callback(this.manager,b,{pointers:c[0],changedPointers:c[1],pointerType:za,srcEvent:a})}});var cb=2500,db=25;i(R,x,{handler:function(a,b,c){var d=c.pointerType==za,e=c.pointerType==Ba;if(!(e&&c.sourceCapabilities&&c.sourceCapabilities.firesTouchEvents)){if(d)S.call(this,b,c);else if(e&&U.call(this,c))return;this.callback(a,b,c)}},destroy:function(){this.touch.destroy(),this.mouse.destroy()}});var eb=u(na.style,"touchAction"),fb=eb!==d,gb="compute",hb="auto",ib="manipulation",jb="none",kb="pan-x",lb="pan-y",mb=X();V.prototype={set:function(a){a==gb&&(a=this.compute()),fb&&this.manager.element.style&&mb[a]&&(this.manager.element.style[eb]=a),this.actions=a.toLowerCase().trim()},update:function(){this.set(this.manager.options.touchAction)},compute:function(){var a=[];return g(this.manager.recognizers,function(b){k(b.options.enable,[b])&&(a=a.concat(b.getTouchAction()))}),W(a.join(" "))},preventDefaults:function(a){var b=a.srcEvent,c=a.offsetDirection;if(this.manager.session.prevented)return void b.preventDefault();var d=this.actions,e=p(d,jb)&&!mb[jb],f=p(d,lb)&&!mb[lb],g=p(d,kb)&&!mb[kb];if(e){var h=1===a.pointers.length,i=a.distance<2,j=a.deltaTime<250;if(h&&i&&j)return}return g&&f?void 0:e||f&&c&Na||g&&c&Oa?this.preventSrc(b):void 0},preventSrc:function(a){this.manager.session.prevented=!0,a.preventDefault()}};var nb=1,ob=2,pb=4,qb=8,rb=qb,sb=16,tb=32;Y.prototype={defaults:{},set:function(a){return la(this.options,a),this.manager&&this.manager.touchAction.update(),this},recognizeWith:function(a){if(f(a,"recognizeWith",this))return this;var b=this.simultaneous;return a=_(a,this),b[a.id]||(b[a.id]=a,a.recognizeWith(this)),this},dropRecognizeWith:function(a){return f(a,"dropRecognizeWith",this)?this:(a=_(a,this),delete this.simultaneous[a.id],this)},requireFailure:function(a){if(f(a,"requireFailure",this))return this;var b=this.requireFail;return a=_(a,this),-1===r(b,a)&&(b.push(a),a.requireFailure(this)),this},dropRequireFailure:function(a){if(f(a,"dropRequireFailure",this))return this;a=_(a,this);var b=r(this.requireFail,a);return b>-1&&this.requireFail.splice(b,1),this},hasRequireFailures:function(){return this.requireFail.length>0},canRecognizeWith:function(a){return!!this.simultaneous[a.id]},emit:function(a){function b(b){c.manager.emit(b,a)}var c=this,d=this.state;qb>d&&b(c.options.event+Z(d)),b(c.options.event),a.additionalEvent&&b(a.additionalEvent),d>=qb&&b(c.options.event+Z(d))},tryEmit:function(a){return this.canEmit()?this.emit(a):void(this.state=tb)},canEmit:function(){for(var a=0;a<this.requireFail.length;){if(!(this.requireFail[a].state&(tb|nb)))return!1;a++}return!0},recognize:function(a){var b=la({},a);return k(this.options.enable,[this,b])?(this.state&(rb|sb|tb)&&(this.state=nb),this.state=this.process(b),void(this.state&(ob|pb|qb|sb)&&this.tryEmit(b))):(this.reset(),void(this.state=tb))},process:function(a){},getTouchAction:function(){},reset:function(){}},i(aa,Y,{defaults:{pointers:1},attrTest:function(a){var b=this.options.pointers;return 0===b||a.pointers.length===b},process:function(a){var b=this.state,c=a.eventType,d=b&(ob|pb),e=this.attrTest(a);return d&&(c&Ha||!e)?b|sb:d||e?c&Ga?b|qb:b&ob?b|pb:ob:tb}}),i(ba,aa,{defaults:{event:"pan",threshold:10,pointers:1,direction:Pa},getTouchAction:function(){var a=this.options.direction,b=[];return a&Na&&b.push(lb),a&Oa&&b.push(kb),b},directionTest:function(a){var b=this.options,c=!0,d=a.distance,e=a.direction,f=a.deltaX,g=a.deltaY;return e&b.direction||(b.direction&Na?(e=0===f?Ia:0>f?Ja:Ka,c=f!=this.pX,d=Math.abs(a.deltaX)):(e=0===g?Ia:0>g?La:Ma,c=g!=this.pY,d=Math.abs(a.deltaY))),a.direction=e,c&&d>b.threshold&&e&b.direction},attrTest:function(a){return aa.prototype.attrTest.call(this,a)&&(this.state&ob||!(this.state&ob)&&this.directionTest(a))},emit:function(a){this.pX=a.deltaX,this.pY=a.deltaY;var b=$(a.direction);b&&(a.additionalEvent=this.options.event+b),this._super.emit.call(this,a)}}),i(ca,aa,{defaults:{event:"pinch",threshold:0,pointers:2},getTouchAction:function(){return[jb]},attrTest:function(a){return this._super.attrTest.call(this,a)&&(Math.abs(a.scale-1)>this.options.threshold||this.state&ob)},emit:function(a){if(1!==a.scale){var b=a.scale<1?"in":"out";a.additionalEvent=this.options.event+b}this._super.emit.call(this,a)}}),i(da,Y,{defaults:{event:"press",pointers:1,time:251,threshold:9},getTouchAction:function(){return[hb]},process:function(a){var b=this.options,c=a.pointers.length===b.pointers,d=a.distance<b.threshold,f=a.deltaTime>b.time;if(this._input=a,!d||!c||a.eventType&(Ga|Ha)&&!f)this.reset();else if(a.eventType&Ea)this.reset(),this._timer=e(function(){this.state=rb,this.tryEmit()},b.time,this);else if(a.eventType&Ga)return rb;return tb},reset:function(){clearTimeout(this._timer)},emit:function(a){this.state===rb&&(a&&a.eventType&Ga?this.manager.emit(this.options.event+"up",a):(this._input.timeStamp=ra(),this.manager.emit(this.options.event,this._input)))}}),i(ea,aa,{defaults:{event:"rotate",threshold:0,pointers:2},getTouchAction:function(){return[jb]},attrTest:function(a){return this._super.attrTest.call(this,a)&&(Math.abs(a.rotation)>this.options.threshold||this.state&ob)}}),i(fa,aa,{defaults:{event:"swipe",threshold:10,velocity:.3,direction:Na|Oa,pointers:1},getTouchAction:function(){return ba.prototype.getTouchAction.call(this)},attrTest:function(a){var b,c=this.options.direction;return c&(Na|Oa)?b=a.overallVelocity:c&Na?b=a.overallVelocityX:c&Oa&&(b=a.overallVelocityY),this._super.attrTest.call(this,a)&&c&a.offsetDirection&&a.distance>this.options.threshold&&a.maxPointers==this.options.pointers&&qa(b)>this.options.velocity&&a.eventType&Ga},emit:function(a){var b=$(a.offsetDirection);b&&this.manager.emit(this.options.event+b,a),this.manager.emit(this.options.event,a)}}),i(ga,Y,{defaults:{event:"tap",pointers:1,taps:1,interval:300,time:250,threshold:9,posThreshold:10},getTouchAction:function(){return[ib]},process:function(a){var b=this.options,c=a.pointers.length===b.pointers,d=a.distance<b.threshold,f=a.deltaTime<b.time;if(this.reset(),a.eventType&Ea&&0===this.count)return this.failTimeout();if(d&&f&&c){if(a.eventType!=Ga)return this.failTimeout();var g=this.pTime?a.timeStamp-this.pTime<b.interval:!0,h=!this.pCenter||H(this.pCenter,a.center)<b.posThreshold;this.pTime=a.timeStamp,this.pCenter=a.center,h&&g?this.count+=1:this.count=1,this._input=a;var i=this.count%b.taps;if(0===i)return this.hasRequireFailures()?(this._timer=e(function(){this.state=rb,this.tryEmit()},b.interval,this),ob):rb}return tb},failTimeout:function(){return this._timer=e(function(){this.state=tb},this.options.interval,this),tb},reset:function(){clearTimeout(this._timer)},emit:function(){this.state==rb&&(this._input.tapCount=this.count,this.manager.emit(this.options.event,this._input))}}),ha.VERSION="2.0.7",ha.defaults={domEvents:!1,touchAction:gb,enable:!0,inputTarget:null,inputClass:null,preset:[[ea,{enable:!1}],[ca,{enable:!1},["rotate"]],[fa,{direction:Na}],[ba,{direction:Na},["swipe"]],[ga],[ga,{event:"doubletap",taps:2},["tap"]],[da]],cssProps:{userSelect:"none",touchSelect:"none",touchCallout:"none",contentZooming:"none",userDrag:"none",tapHighlightColor:"rgba(0,0,0,0)"}};var ub=1,vb=2;ia.prototype={set:function(a){return la(this.options,a),a.touchAction&&this.touchAction.update(),a.inputTarget&&(this.input.destroy(),this.input.target=a.inputTarget,this.input.init()),this},stop:function(a){this.session.stopped=a?vb:ub},recognize:function(a){var b=this.session;if(!b.stopped){this.touchAction.preventDefaults(a);var c,d=this.recognizers,e=b.curRecognizer;(!e||e&&e.state&rb)&&(e=b.curRecognizer=null);for(var f=0;f<d.length;)c=d[f],b.stopped===vb||e&&c!=e&&!c.canRecognizeWith(e)?c.reset():c.recognize(a),!e&&c.state&(ob|pb|qb)&&(e=b.curRecognizer=c),f++}},get:function(a){if(a instanceof Y)return a;for(var b=this.recognizers,c=0;c<b.length;c++)if(b[c].options.event==a)return b[c];return null},add:function(a){if(f(a,"add",this))return this;var b=this.get(a.options.event);return b&&this.remove(b),this.recognizers.push(a),a.manager=this,this.touchAction.update(),a},remove:function(a){if(f(a,"remove",this))return this;if(a=this.get(a)){var b=this.recognizers,c=r(b,a);-1!==c&&(b.splice(c,1),this.touchAction.update())}return this},on:function(a,b){if(a!==d&&b!==d){var c=this.handlers;return g(q(a),function(a){c[a]=c[a]||[],c[a].push(b)}),this}},off:function(a,b){if(a!==d){var c=this.handlers;return g(q(a),function(a){b?c[a]&&c[a].splice(r(c[a],b),1):delete c[a]}),this}},emit:function(a,b){this.options.domEvents&&ka(a,b);var c=this.handlers[a]&&this.handlers[a].slice();if(c&&c.length){b.type=a,b.preventDefault=function(){b.srcEvent.preventDefault()};for(var d=0;d<c.length;)c[d](b),d++}},destroy:function(){this.element&&ja(this,!1),this.handlers={},this.session={},this.input.destroy(),this.element=null}},la(ha,{INPUT_START:Ea,INPUT_MOVE:Fa,INPUT_END:Ga,INPUT_CANCEL:Ha,STATE_POSSIBLE:nb,STATE_BEGAN:ob,STATE_CHANGED:pb,STATE_ENDED:qb,STATE_RECOGNIZED:rb,STATE_CANCELLED:sb,STATE_FAILED:tb,DIRECTION_NONE:Ia,DIRECTION_LEFT:Ja,DIRECTION_RIGHT:Ka,DIRECTION_UP:La,DIRECTION_DOWN:Ma,DIRECTION_HORIZONTAL:Na,DIRECTION_VERTICAL:Oa,DIRECTION_ALL:Pa,Manager:ia,Input:x,TouchAction:V,TouchInput:P,MouseInput:L,PointerEventInput:M,TouchMouseInput:R,SingleTouchInput:N,Recognizer:Y,AttrRecognizer:aa,Tap:ga,Pan:ba,Swipe:fa,Pinch:ca,Rotate:ea,Press:da,on:m,off:n,each:g,merge:ta,extend:sa,assign:la,inherit:i,bindFn:j,prefixed:u});var wb="undefined"!=typeof a?a:"undefined"!=typeof self?self:{};wb.Hammer=ha,"function"==typeof define&&define.amd?define(function(){return ha}):"undefined"!=typeof module&&module.exports?module.exports=ha:a[c]=ha}(window,document,"Hammer");

// ============================================
// EASY GESTURE WRAPPER - With Scroll Prevention
// ============================================
const Gesture = (function() {
    const instances = new Map();
    
    function getInstance(element) {
        if (!instances.has(element)) {
            // Create Hammer instance with touch-action prevention
            const hammer = new Hammer(element);
            
            // Prevent default touch behavior to stop scrolling
            hammer.get('swipe').set({ 
                direction: Hammer.DIRECTION_ALL,
                threshold: 10,
                velocity: 0.3
            });
            
            // Block default touchmove to prevent scrolling
            element.addEventListener('touchmove', function(e) {
                // Only prevent if gesture is active
                if (hammer.session && hammer.session.curRecognizer) {
                    e.preventDefault();
                }
            }, { passive: false });
            
            // Also prevent mouse wheel scroll during drag on desktop
            element.addEventListener('wheel', function(e) {
                if (hammer.session && hammer.session.curRecognizer) {
                    e.preventDefault();
                }
            }, { passive: false });
            
            instances.set(element, hammer);
        }
        return instances.get(element);
    }
    
    return {
        // Swipe directions (callback receives event with position data)
        left: (element, callback) => getInstance(element).on('swipeleft', callback),
        right: (element, callback) => getInstance(element).on('swiperight', callback),
        up: (element, callback) => getInstance(element).on('swipeup', callback),
        down: (element, callback) => getInstance(element).on('swipedown', callback),
        
        // Long press / hold (callback receives event with position data)
        hold: (element, callback) => getInstance(element).on('press', callback),
        
        // Any swipe direction (callback receives event with position data)
        swipe: (element, callback) => {
            const h = getInstance(element);
            h.on('swipeleft swiperight swipeup swipedown', callback);
        },
        
        // Remove event listener
        off: (element, event, callback) => {
            const h = instances.get(element);
            if (h) h.off(event, callback);
        },
        
        // Clean up and remove all gestures
        destroy: (element) => {
            const h = instances.get(element);
            if (h) {
                h.destroy();
                instances.delete(element);
            }
        }
    };
})();





// custom marquee
function CustomMarquee() {
    class ViteCSSMarquee {
        constructor(element) {
            this.element = element;
            this.wrapper = null;
            this.animationId = null;
            this.isRunning = false;
            this.canAnimate = true;
            this.currentX = 0;
            this.startX = 0;
            this.endX = 0;
            this.duration = 0;
            this.startTime = null;
            this.eventListeners = [];
            this.config = null;
            this.resizeTimer = null;
            this.resizeObserver = null;
            this.visibilityObserver = null;
            this.contentObserver = null;
            this.RESIZE_DELAY = 250;
            
            this.config = this.parseAttributes();
            this.init();
        }

        parseAttributes() {
            return {
                core: {
                    active: this.element.hasAttribute("vitecss-marquee"),
                    id: this.element.getAttribute("vitecss-marquee-id") || undefined
                },
                animation: {
                    speed: Number(this.element.getAttribute("vitecss-marquee-speed") || 50),
                    direction: this.element.getAttribute("vitecss-marquee-direction") || "left",
                    gap: Number(this.element.getAttribute("vitecss-marquee-gap") || 20),
                    duplicates: Number(this.element.getAttribute("vitecss-marquee-duplicates") || 0)
                },
                behavior: {
                    pauseOnHover: this.element.getAttribute("vitecss-marquee-pause-hover") === "true" || false,
                    loop: Number(this.element.getAttribute("vitecss-marquee-loop") || -1),
                    pauseWhenNotVisible: this.element.getAttribute("vitecss-marquee-pause-visible") === "true" || false
                },
                checkOverflow: {
                    toCheck: this.element.hasAttribute('vitecss-marquee-check')
                }
            };
        }

        init() {
            this.setupWrapper();
            
            setTimeout(() => {
                this.checkAndStart();
            }, 100);
            
            this.bindEvents();
            this.bindResizeEvent();
            this.setupContentObserver();
            
            if (this.config.behavior.pauseWhenNotVisible) {
                this.setupVisibilityObserver();
            }
        }

        checkAndStart() {
            if (this.shouldAnimate()) {
                this.start();
            } else {
                console.log(`[Marquee ${this.config.core.id || 'unnamed'}] Content does not overflow - animation prevented`);
                this.stop();
                this.canAnimate = false;
            }
        }

        shouldAnimate() {
            if (!this.config.checkOverflow.toCheck) {
                return true;
            }
            
            const containerWidth = this.element.clientWidth;
            const contentWidth = this.getTotalWidth();
            const overflows = contentWidth > containerWidth;
            
            return overflows;
        }

        recheckOverflow() {
            if (!this.config.checkOverflow.toCheck) return;
            
            // Store current state
            const wasAnimating = this.isRunning;
            
            // Re-evaluate
            const shouldAnimate = this.shouldAnimate();
            
            if (shouldAnimate && !this.canAnimate) {
                console.log('[Marquee] Overflow detected - starting animation');
                this.canAnimate = true;
                this.stop();
                this.start();
            } else if (!shouldAnimate && this.canAnimate) {
                console.log('[Marquee] No overflow - stopping animation');
                this.canAnimate = false;
                this.stop();
            } else if (shouldAnimate && wasAnimating) {
                // If already animating, just continue
                return;
            }
        }

        setupContentObserver() {
            // Create a mutation observer to watch for content changes
            this.contentObserver = new MutationObserver((mutations) => {
                let contentChanged = false;
                
                mutations.forEach((mutation) => {
                    if (mutation.type === 'childList' || mutation.type === 'characterData') {
                        contentChanged = true;
                    }
                    if (mutation.type === 'attributes' && mutation.attributeName === 'style') {
                        contentChanged = true;
                    }
                });
                
                if (contentChanged) {
                    console.log('[Marquee] Content changed - rechecking overflow');
                    // Small delay to allow DOM to update
                    setTimeout(() => {
                        this.recheckOverflow();
                    }, 50);
                }
            });
            
            // Observe the wrapper for content changes
            if (this.wrapper) {
                this.contentObserver.observe(this.wrapper, {
                    childList: true,
                    subtree: true,
                    characterData: true,
                    attributes: true,
                    attributeFilter: ['style', 'class']
                });
            }
            
            // Also observe the original element for attribute changes
            this.contentObserver.observe(this.element, {
                attributes: true,
                attributeFilter: ['style', 'class']
            });
            
            this.eventListeners.push(() => this.contentObserver.disconnect());
        }

        setupWrapper() {
            this.setWrapperStyles();
            this.createClonesAndAddStyles();
        }

        setWrapperStyles() {
            this.wrapper = document.createElement("div");
            this.wrapper.style.display = "flex";
            this.wrapper.style.flexWrap = "nowrap";
            this.wrapper.style.position = "relative";
            this.wrapper.style.width = "max-content";
            this.wrapper.style.willChange = "transform";
            this.wrapper.style.backfaceVisibility = "hidden";
            this.wrapper.style.justifyContent = "flex-start";
            this.wrapper.style.alignItems = "center";
            this.wrapper.style.gap = this.getGapValue();
        }

        createClonesAndAddStyles() {
            let gap = this.getGapValue();
            
            let originalChildren = Array.from(this.element.children);
            
            if (originalChildren.length === 0) {
                console.error('[Marquee] No content found inside marquee element');
                return;
            }
            
            let originalHTML = this.element.innerHTML;
            
            this.element.style.justifyContent = "flex-start";
            this.element.style.overflow = "hidden";
            this.element.style.width = "100%";
            this.element.style.position = "relative";
            this.element.innerHTML = "";
            
            this.wrapper.innerHTML = originalHTML;
            
            let wrapperChildren = this.wrapper.children;
            for (let i = 0; i < wrapperChildren.length; i++) {
                wrapperChildren[i].style.flexShrink = "0";
                wrapperChildren[i].style.minWidth = "max-content";
            }
            
            let duplicates = this.config.animation.duplicates;
            for (let i = 0; i < duplicates; i++) {
                let clone = document.createElement("div");
                clone.innerHTML = originalHTML;
                clone.style.display = "flex";
                clone.style.gap = gap;
                clone.style.flexShrink = "0";
                
                let cloneChildren = clone.children;
                for (let j = 0; j < cloneChildren.length; j++) {
                    cloneChildren[j].style.flexShrink = "0";
                    cloneChildren[j].style.minWidth = "max-content";
                }
                
                this.wrapper.appendChild(clone);
            }
            
            this.element.appendChild(this.wrapper);
        }

        getGapValue() {
            let computedGap = window.getComputedStyle(this.element).getPropertyValue("gap");
            if (computedGap && computedGap !== "0px" && computedGap !== "normal") {
                return computedGap;
            }
            return `${this.config.animation.gap}px`;
        }

        getTotalWidth() {
            if (!this.wrapper || !this.wrapper.firstElementChild) return 0;
            
            let gapValue = parseFloat(this.getGapValue()) || 0;
            let totalWidth = 0;
            
            for (let i = 0; i < this.wrapper.children.length; i++) {
                totalWidth += this.wrapper.children[i].scrollWidth;
                if (i < this.wrapper.children.length - 1) {
                    totalWidth += gapValue;
                }
            }
            
            return totalWidth;
        }

        startAnimation() {
            if (!this.shouldAnimate()) {
                console.log('[Marquee] startAnimation prevented - no overflow');
                this.canAnimate = false;
                return;
            }
            
            if (!this.wrapper) {
                console.error('[Marquee] Wrapper not initialized');
                return;
            }
            
            let totalWidth = this.getTotalWidth();
            let containerWidth = this.element.clientWidth;
            let direction = this.config.animation.direction;
            
            if (totalWidth === 0) {
                console.error('[Marquee] Total width is 0, cannot animate');
                return;
            }
            
            if (direction === "left") {
                this.startX = containerWidth;
                this.endX = -totalWidth;
            } else {
                this.startX = -totalWidth;
                this.endX = containerWidth;
            }
            
            let distance = Math.abs(this.endX - this.startX);
            this.duration = (distance / this.config.animation.speed) * 1000;
            
            this.currentX = this.startX;
            this.wrapper.style.transform = `translate3d(${this.currentX}px, 0, 0)`;
            
            this.isRunning = true;
            this.startTime = performance.now();
            this.animate();
        }

        animate(currentTime = null) {
            if (!this.isRunning) return;
            
            if (this.config.checkOverflow.toCheck && !this.shouldAnimate()) {
                this.pause();
                this.canAnimate = false;
                return;
            }
            
            if (currentTime === null) {
                currentTime = performance.now();
            }
            
            let elapsed = currentTime - this.startTime;
            let progress = Math.min(elapsed / this.duration, 1);
            
            this.currentX = this.startX + (this.endX - this.startX) * progress;
            this.wrapper.style.transform = `translate3d(${this.currentX}px, 0, 0)`;
            
            if (progress >= 1) {
                this.currentX = this.startX;
                this.wrapper.style.transform = `translate3d(${this.currentX}px, 0, 0)`;
                this.startTime = performance.now();
                this.animationId = requestAnimationFrame((time) => this.animate(time));
            } else {
                this.animationId = requestAnimationFrame((time) => this.animate(time));
            }
        }

        bindEvents() {
            if (this.config.behavior.pauseOnHover) {
                let pauseHandler = () => this.pause();
                let resumeHandler = () => this.resume();
                
                this.element.addEventListener("mouseenter", pauseHandler);
                this.element.addEventListener("mouseleave", resumeHandler);
                
                this.eventListeners.push(() => {
                    this.element.removeEventListener("mouseenter", pauseHandler);
                    this.element.removeEventListener("mouseleave", resumeHandler);
                });
            }
        }

        bindResizeEvent() {
            let resizeHandler = () => {
                if (this.resizeTimer) clearTimeout(this.resizeTimer);
                this.resizeTimer = setTimeout(() => {
                    let wasRunning = this.isRunning;
                    if (wasRunning) this.pause();
                    this.updateDimensions();
                    this.recheckOverflow();
                    if (wasRunning && this.canAnimate) this.resume();
                }, this.RESIZE_DELAY);
            };
            
            window.addEventListener("resize", resizeHandler);
            this.eventListeners.push(() => {
                window.removeEventListener("resize", resizeHandler);
                if (this.resizeTimer) clearTimeout(this.resizeTimer);
            });
            
            if (window.ResizeObserver) {
                this.resizeObserver = new ResizeObserver(() => {
                    if (this.resizeTimer) clearTimeout(this.resizeTimer);
                    this.resizeTimer = setTimeout(() => {
                        this.recheckOverflow();
                        if (this.isRunning && this.canAnimate) {
                            this.updateDimensions();
                        }
                    }, this.RESIZE_DELAY);
                });
                this.resizeObserver.observe(this.element);
                this.eventListeners.push(() => this.resizeObserver.disconnect());
            }
        }

        updateDimensions() {
            if (!this.canAnimate) return;
            
            let totalWidth = this.getTotalWidth();
            let containerWidth = this.element.clientWidth;
            let direction = this.config.animation.direction;
            
            if (direction === "left") {
                this.startX = containerWidth;
                this.endX = -totalWidth;
            } else {
                this.startX = -totalWidth;
                this.endX = containerWidth;
            }
            
            let distance = Math.abs(this.endX - this.startX);
            this.duration = (distance / this.config.animation.speed) * 1000;
            
            this.currentX = this.startX;
            this.wrapper.style.transform = `translate3d(${this.currentX}px, 0, 0)`;
        }

        setupVisibilityObserver() {
            this.visibilityObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        if (this.canAnimate) this.resume();
                    } else {
                        this.pause();
                    }
                });
            }, { root: null, threshold: 0.1 });
            
            this.visibilityObserver.observe(this.element);
            this.eventListeners.push(() => this.visibilityObserver.disconnect());
        }

        pause() {
            if (this.isRunning) {
                this.isRunning = false;
                if (this.animationId) {
                    cancelAnimationFrame(this.animationId);
                    this.animationId = null;
                }
            }
        }

        resume() {
            if (!this.canAnimate) {
                console.log('[Marquee] Resume prevented - content does not overflow');
                return;
            }
            
            if (!this.isRunning && this.wrapper) {
                this.isRunning = true;
                this.startTime = performance.now() - (this.startTime ? (performance.now() - this.startTime) : 0);
                this.animate();
            }
        }

        start() {
            if (!this.shouldAnimate()) {
                this.canAnimate = false;
                console.log('[Marquee] Start prevented - content does not overflow');
                return;
            }
            
            this.canAnimate = true;
            
            if (!this.isRunning) {
                if (this.animationId) {
                    cancelAnimationFrame(this.animationId);
                }
                this.startAnimation();
            }
        }

        stop() {
            if (this.isRunning) {
                this.isRunning = false;
                if (this.animationId) {
                    cancelAnimationFrame(this.animationId);
                    this.animationId = null;
                }
                if (this.wrapper) {
                    this.currentX = 0;
                    this.wrapper.style.transform = `translate3d(0, 0, 0)`;
                }
            }
        }

        update(config) {
            if (config.animation?.speed && config.animation.speed <= 0) {
                console.warn("[Marquee] Animation speed must be greater than 0");
                return;
            }
            
            if (config.animation) {
                this.config.animation = { ...this.config.animation, ...config.animation };
            }
            
            if (config.behavior) {
                this.config.behavior = { ...this.config.behavior, ...config.behavior };
            }
            
            let wasRunning = this.isRunning;
            if (wasRunning) this.pause();
            
            if (this.wrapper) {
                this.wrapper.style.gap = this.getGapValue();
            }
            
            this.updateDimensions();
            this.recheckOverflow();
            
            if (wasRunning && this.canAnimate) this.resume();
        }

        destroy() {
            this.stop();
            if (this.resizeTimer) clearTimeout(this.resizeTimer);
            this.eventListeners.forEach(cleanup => cleanup());
            this.eventListeners = [];
            if (this.wrapper && this.wrapper.parentNode) {
                this.wrapper.parentNode.removeChild(this.wrapper);
            }
        }
    }

    // Make initializeMarquees globally available
    window.initializeMarquees = function() {
        console.log('Initializing marquees...');
        const marquees = document.querySelectorAll("[vitecss-marquee]");
        console.log(`Found ${marquees.length} marquees`);
        marquees.forEach(element => {
            if (!element.vitecssMarquee) {
                let marquee = new ViteCSSMarquee(element);
                element.vitecssMarquee = marquee;
            }
        });
    };

    // Auto-initialize on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', window.initializeMarquees);
    } else {
        window.initializeMarquees();
    }

    window.vitecssMarquee = ViteCSSMarquee;
}

// Execute the function
CustomMarquee();


// countdown
// script.js - Advanced Countdown Timer Utility with Full Time Formatting
(function(global) {
    let countdownInterval = null;

    // Advanced time formatting function
    function formatTime(seconds, format = 'auto') {
        const units = {
            year: 31536000,    // 365 days
            month: 2592000,    // 30 days
            week: 604800,
            day: 86400,
            hour: 3600,
            minute: 60,
            second: 1
        };
        
        let remaining = Math.abs(seconds);
        const parts = [];
        
        // Calculate each unit
        const years = Math.floor(remaining / units.year);
        remaining %= units.year;
        
        const months = Math.floor(remaining / units.month);
        remaining %= units.month;
        
        const weeks = Math.floor(remaining / units.week);
        remaining %= units.week;
        
        const days = Math.floor(remaining / units.day);
        remaining %= units.day;
        
        const hours = Math.floor(remaining / units.hour);
        remaining %= units.hour;
        
        const minutes = Math.floor(remaining / units.minute);
        const secs = remaining % units.minute;
        
        // Format based on requested format type
        switch(format) {
            case 'full':
                if (years > 0) parts.push(`${years}y`);
                if (months > 0) parts.push(`${months}mo`);
                if (weeks > 0) parts.push(`${weeks}w`);
                if (days > 0) parts.push(`${days}d`);
                if (hours > 0) parts.push(`${hours}h`);
                if (minutes > 0) parts.push(`${minutes}m`);
                if (secs > 0 || parts.length === 0) parts.push(`${secs}s`);
                return parts.join(' ');
                
            case 'verbose':
                if (years > 0) parts.push(`${years} year${years !== 1 ? 's' : ''}`);
                if (months > 0) parts.push(`${months} month${months !== 1 ? 's' : ''}`);
                if (weeks > 0) parts.push(`${weeks} week${weeks !== 1 ? 's' : ''}`);
                if (days > 0) parts.push(`${days} day${days !== 1 ? 's' : ''}`);
                if (hours > 0) parts.push(`${hours} hour${hours !== 1 ? 's' : ''}`);
                if (minutes > 0) parts.push(`${minutes} minute${minutes !== 1 ? 's' : ''}`);
                if (secs > 0 || parts.length === 0) parts.push(`${secs} second${secs !== 1 ? 's' : ''}`);
                return parts.join(', ');
                
            case 'human':
                if (years > 0) return `${years} year${years !== 1 ? 's' : ''}`;
                if (months > 0) return `${months} month${months !== 1 ? 's' : ''}`;
                if (weeks > 0) return `${weeks} week${weeks !== 1 ? 's' : ''}`;
                if (days > 0) return `${days} day${days !== 1 ? 's' : ''}`;
                if (hours > 0) return `${hours} hour${hours !== 1 ? 's' : ''}`;
                if (minutes > 0) return `${minutes} minute${minutes !== 1 ? 's' : ''}`;
                return `${secs} second${secs !== 1 ? 's' : ''}`;
                
            case 'compact':
                if (years > 0) return `${years}y ${months}mo`;
                if (months > 0) return `${months}mo ${days}d`;
                if (weeks > 0) return `${weeks}w ${days % 7}d`;
                if (days > 0) return `${days}d ${hours}h`;
                if (hours > 0) return `${hours}h ${minutes}m`;
                if (minutes > 0) return `${minutes}m ${secs}s`;
                return `${secs}s`;
                
            case 'datetime':
                return `${years.toString().padStart(4, '0')}-${months.toString().padStart(2, '0')}-${days.toString().padStart(2, '0')} ${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
                
            case 'clock':
                const h = hours + (days * 24);
                return `${h.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
                
            case 'auto':
            default:
                if (years > 0) return `${years}y ${months}mo ${days}d`;
                if (months > 0) return `${months}mo ${days}d ${hours}h`;
                if (days > 0) return `${days}d ${hours}h ${minutes}m`;
                if (hours > 0) return `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
                if (minutes > 0) return `${minutes.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
                return `${secs}s`;
        }
    }
    
    // Convert date to seconds from now
    function dateToSeconds(targetDate) {
        const now = new Date();
        const target = new Date(targetDate);
        const diffSeconds = Math.floor((target - now) / 1000);
        return diffSeconds;
    }
    
    /**
     * STARTCOUNTDOWN FUNCTION - Complete Usage Guide
     * 
     * @param {number|string|Date} time - Can be:
     *    - Number: seconds (e.g., 60, 3600, 86400)
     *    - String: date string (e.g., "2025-12-25", "2025-01-01T00:00:00")
     *    - Date object: (e.g., new Date("2025-12-25"))
     * 
     * @param {Object} options - Optional configuration object
     *    - displayElement: (HTMLElement) Element to show timer. Default: document.getElementById("timer-display")
     *    - format: (string) Display format. Options: 'auto', 'full', 'verbose', 'human', 'compact', 'datetime', 'clock'
     *    - showMilliseconds: (boolean) Show milliseconds. Default: false
     *    - onTick: (function) Callback every second. Receives (remainingSeconds, formattedTime, verboseTime)
     *    - onComplete: (function) Callback when timer ends
     *    - alert: (boolean) Show alert on completion. Default: true
     * 
     * @returns {boolean} - Returns true if timer started successfully
     * 
     * ============ HOW TO USE ============
     * 
     * 1. BASIC USAGE:
     *    startCountdown(60);  // Countdown 60 seconds
     * 
     * 2. WITH CUSTOM DISPLAY ELEMENT:
     *    startCountdown(120, { displayElement: document.getElementById("my-timer") });
     * 
     * 3. DIFFERENT FORMATS:
     *    startCountdown(3661, { format: 'clock' });        // 01:01:01
     *    startCountdown(90061, { format: 'full' });        // 1d 1h 1m 1s
     *    startCountdown(90061, { format: 'verbose' });     // 1 day, 1 hour, 1 minute, 1 second
     *    startCountdown(90061, { format: 'human' });       // 1 day
     *    startCountdown(90061, { format: 'compact' });     // 1d 1h
     *    startCountdown(3661, { format: 'datetime' });     // 0000-00-00 01:01:01
     * 
     * 4. COUNTDOWN TO DATE:
     *    startCountdown("2025-12-25");                     // Christmas countdown
     *    startCountdown("2025-01-01T00:00:00");
     *    startCountdown(new Date("2025-12-25"));
     * 
     * 5. WITH CALLBACKS:
     *    startCountdown(10, {
     *        onTick: (seconds, formatted, verbose) => {
     *            console.log(`Time left: ${formatted}`);
     *        },
     *        onComplete: () => {
     *            console.log("Timer finished!");
     *        }
     *    });
     * 
     * 6. WITH MILLISECONDS (ultra precise):
     *    startCountdown(5, { 
     *        format: 'clock',
     *        showMilliseconds: true 
     *    });
     * 
     * 7. WITHOUT ALERT:
     *    startCountdown(30, { alert: false });
     * 
     * 8. STOP TIMER:
     *    stopCountdown();
     * 
     * 9. GET REMAINING TIME (debug):
     *    getRemainingTime();
     * 
     * ============ EXAMPLES ============
     * 
     * // Example 1: Simple 1 minute timer
     * startCountdown(60);
     * 
     * // Example 2: Countdown to New Year with verbose format
     * startCountdown("2026-01-01", {
     *     format: 'verbose',
     *     onComplete: () => console.log("Happy New Year! 🎉")
     * });
     * 
     * // Example 3: 24-hour countdown with clock format
     * startCountdown(86400, { format: 'clock' });
     * 
     * // Example 4: Birthday countdown with custom element
     * const birthdayDisplay = document.getElementById("birthday-timer");
     * startCountdown("2025-06-15", {
     *     displayElement: birthdayDisplay,
     *     format: 'human',
     *     onComplete: () => alert("Happy Birthday! 🎂")
     * });
     * 
     */
    function startCountdown(time, options = {}) {
        // Clear any existing timer
        if (countdownInterval) {
            clearInterval(countdownInterval);
            countdownInterval = null;
        }
        
        let remainingTime;
        
        // Handle different input types
        if (typeof time === 'string') {
            // Check if it's a date string
            if (!isNaN(Date.parse(time))) {
                remainingTime = dateToSeconds(time);
            } else {
                console.error("Invalid date string provided");
                return false;
            }
        } else if (typeof time === 'number') {
            remainingTime = time;
        } else if (time instanceof Date) {
            remainingTime = dateToSeconds(time);
        } else {
            console.error("Please provide a number (seconds), Date object, or date string");
            return false;
        }
        
        // Validate input
        if (isNaN(remainingTime) || remainingTime <= 0) {
            console.error("Please provide a positive number of seconds or future date");
            return false;
        }
        
        // Get display element
        const timerDisplay = options.displayElement || document.getElementById("timer-display");
        if (!timerDisplay) {
            console.error("Timer display element not found");
            return false;
        }
        
        // Format options
        const format = options.format || 'auto';
        const showMilliseconds = options.showMilliseconds || false;
        
        // Callbacks
        const onTick = options.onTick || null;
        const onComplete = options.onComplete || null;
        
        // Display the starting time
        timerDisplay.textContent = formatTime(remainingTime, format);
        
        let lastTimestamp = Date.now();
        
        // Start the countdown
        countdownInterval = setInterval(() => {
            remainingTime--;
            
            if (remainingTime >= 0) {
                let displayTime = remainingTime;
                let formattedTime = formatTime(displayTime, format);
                
                // Add milliseconds if requested
                if (showMilliseconds) {
                    const now = Date.now();
                    const milliseconds = 999 - (now - lastTimestamp);
                    lastTimestamp = now;
                    formattedTime = `${formattedTime}.${Math.floor(milliseconds).toString().padStart(3, '0')}`;
                }
                
                timerDisplay.textContent = formattedTime;
                if (onTick) onTick(remainingTime, formattedTime, formatTime(remainingTime, 'verbose'));
            } else {
                // Timer finished
                clearInterval(countdownInterval);
                countdownInterval = null;
                timerDisplay.textContent = formatTime(0, format);
                
                if (onComplete) {
                    onComplete();
                } else {
                    console.log("Time's up!");
                    if (options.alert !== false) alert("Time's up!");
                }
            }
        }, showMilliseconds ? 10 : 1000);
        
        return true;
    }
    
    // Stop the countdown
    function stopCountdown() {
        if (countdownInterval) {
            clearInterval(countdownInterval);
            countdownInterval = null;
            console.log("Timer stopped");
            return true;
        }
        console.log("No active timer to stop");
        return false;
    }
    
    // Get remaining time without displaying
    function getRemainingTime() {
        return countdownInterval ? 'Timer running' : 'No active timer';
    }
    
    // Expose to global scope
    global.startCountdown = startCountdown;
    global.stopCountdown = stopCountdown;
    global.formatTime = formatTime;
    global.getRemainingTime = getRemainingTime;
    
})(window);



function SpaLoader(element){
    // spa loader to be updated nased on script
    let loader=` <div class="spa-loader">
 <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><circle cx="4" cy="12" r="3"><animate id="spinner_qFRN" begin="0;spinner_OcgL.end+0.25s" attributeName="cy" calcMode="spline" dur="0.6s" values="12;6;12" keySplines=".33,.66,.66,1;.33,0,.66,.33"/></circle><circle cx="12" cy="12" r="3"><animate begin="spinner_qFRN.begin+0.1s" attributeName="cy" calcMode="spline" dur="0.6s" values="12;6;12" keySplines=".33,.66,.66,1;.33,0,.66,.33"/></circle><circle cx="20" cy="12" r="3"><animate id="spinner_OcgL" begin="spinner_qFRN.begin+0.2s" attributeName="cy" calcMode="spline" dur="0.6s" values="12;6;12" keySplines=".33,.66,.66,1;.33,0,.66,.33"/></circle></svg>
      </div>
`;
    element.innerHTML=loader;
}
//  btn loader
function BtnLoader(element){
    // button loaders on submission to be updated based on script
    let loader=` <!--By Sam Herbert (@sherb), for everyone. More @ http://goo.gl/7AJzbL--><!--Todo: add easing--><svg viewBox="0 0 57 60" xmlns="http://www.w3.org/2000/svg" stroke="currentColor"><g fill="none" fill-rule="evenodd"><g transform="translate(1 1)" stroke-width="3"><circle cx="5" cy="50" r="5"><animate attributeName="cy" begin="0s" dur="2.2s" values="50;5;50;50" calcMode="linear" repeatCount="indefinite"/><animate attributeName="cx" begin="0s" dur="2.2s" values="5;27;49;5" calcMode="linear" repeatCount="indefinite"/></circle><circle cx="27" cy="5" r="5"><animate attributeName="cy" begin="0s" dur="2.2s" from="5" to="5" values="5;50;50;5" calcMode="linear" repeatCount="indefinite"/><animate attributeName="cx" begin="0s" dur="2.2s" from="27" to="27" values="27;49;5;27" calcMode="linear" repeatCount="indefinite"/></circle><circle cx="49" cy="50" r="5"><animate attributeName="cy" begin="0s" dur="2.2s" values="50;50;5;50" calcMode="linear" repeatCount="indefinite"/><animate attributeName="cx" from="49" to="49" begin="0s" dur="2.2s" values="49;5;27;49" calcMode="linear" repeatCount="indefinite"/></circle></g></g></svg>
     `;
 
    if(!element.classList.contains('active')){
        element.classList.add('active');
    }
    let svg_loader=element.querySelector('.svg-loader');
    if(!svg_loader){
      let div=document.createElement('div');
      div.classList.add('svg-loader');
      div.classList.add('row');
      div.classList.add('align-center');
      div.classList.add('g-10');
      div.innerHTML=loader;  
      
      element.appendChild(div);
    
    }
}
// action loader
function ActionLoader(){
    document.querySelector('.action-loader').classList.remove('display-none');
    document.body.classList.add('overflow-hidden');

}
    // action loader
function HideActionLoader(){
    document.querySelector('.action-loader').classList.add('display-none');
    document.body.classList.remove('overflow-hidden');

}
// wrap button raw text
function WrapBtnText(element) {
  // Go through all child nodes
  element.childNodes.forEach(node => {
    // Only target raw text nodes
    if (node.nodeType === Node.TEXT_NODE) {
      let text = node.textContent.trim();
      if (text.length > 0) {
        // Replace the text node with a span wrapping it
        let span = document.createElement('span');
        span.textContent = text;
        node.replaceWith(span);
      }
    }
  });
}
//  show ball loading
function BallLoad(){
    document.body.classList.add('loading');
}
//  hide ball loading
function HideBallLoad(){
   document.body.classList.remove('loading');
}
function IsJSONABLE(data){
    try{
      JSON.parse(data);
      return true;
    }catch{
        return false;
    }
}

// mask-input.js - Reusable utility for vitecss-type="password" inputs

class PasswordMaskUtility {
  constructor() {
    this.inputs = new Map(); // Track each input's state
    this.init();
  }
  
  // Initialize all inputs with vitecss-type="password"
  init() {
    const elements = document.querySelectorAll('input[vitecss-type="password"]');
    elements.forEach(input => this.setupInput(input));
    
    // Watch for dynamically added inputs
    this.observeNewInputs();
  }
  
  // Setup individual input
  setupInput(input) {
    // Skip if already set up
    if (input._maskSetup) return;
    
    const state = {
      realValue: '',
      isMasked: true
    };
    
    input._maskState = state;
    input._maskSetup = true;
    
    // Set attributes
    input.setAttribute('vitecss-value', '');
    input.type = 'text'; // Ensure type is text
    
    // Store methods on input for external access
    input.getRealValue = () => state.realValue;
    input.setRealValue = (val) => {
      state.realValue = val || '';
      if (state.isMasked) {
        input.value = '•'.repeat(state.realValue.length);
      } else {
        input.value = state.realValue;
      }
      input.setAttribute('vitecss-value', state.realValue);
    };
    
    input.toggleMasking = () => {
      state.isMasked = !state.isMasked;
      if (state.isMasked) {
        input.value = '•'.repeat(state.realValue.length);
      } else {
        input.value = state.realValue;
      }
      return state.isMasked;
    };
    
    // Handle beforeinput - prevent showing actual characters
    input.addEventListener('beforeinput', (e) => {
      // Store the current real value length before input
      state._beforeLength = state.realValue.length;
    });
    
    // Handle input events (typing, paste, suggestions)
    input.addEventListener('input', (e) => {
      // Get what was typed/pasted
      const inputType = e.inputType;
      const data = e.data;
      
      // Handle different input types
      if (inputType === 'insertText' && data) {
        // Single character or multiple characters from suggestion
        if (data.length === 1) {
          // Single character typed
          state.realValue += data;
        } else {
          // Multiple characters (keyboard suggestion)
          state.realValue += data;
        }
      } else if (inputType === 'insertFromPaste') {
        // Paste event - get from clipboard
        e.preventDefault();
        const pastedText = (e.clipboardData || window.clipboardData).getData('text');
        state.realValue += pastedText;
      } else if (inputType === 'deleteContentBackward') {
        // Backspace
        state.realValue = state.realValue.slice(0, -1);
      } else if (inputType === 'deleteContentForward') {
        // Delete
        const cursorPos = input.selectionStart;
        const bulletCount = input.value.length;
        const charIndex = Math.floor(cursorPos);
        if (charIndex < state.realValue.length) {
          state.realValue = state.realValue.slice(0, charIndex) + state.realValue.slice(charIndex + 1);
        }
      } else if (inputType === 'insertReplacementText') {
        // Keyboard auto-suggestion
        if (data) {
          state.realValue += data;
        }
      }
      
      // Immediately update display with bullets
      input.value = '•'.repeat(state.realValue.length);
      
      // Update vitecss-value attribute
      input.setAttribute('vitecss-value', state.realValue);
      
      // Keep cursor at the end
      this.keepCursorAtEnd(input);
    });
    
    // Handle paste separately to ensure it works
    input.addEventListener('paste', (e) => {
      // Prevent default to avoid double handling
      e.preventDefault();
      
      // Get pasted text
      const pastedText = (e.clipboardData || window.clipboardData).getData('text');
      
      // Add to real value
      state.realValue += pastedText;
      
      // Update display with bullets
      input.value = '•'.repeat(state.realValue.length);
      
      // Update attribute
      input.setAttribute('vitecss-value', state.realValue);
      
      // Keep cursor at the end
      this.keepCursorAtEnd(input);
    });
    
    // Handle keydown for backspace/delete to ensure they work
    input.addEventListener('keydown', (e) => {
      if (e.key === 'Backspace') {
        e.preventDefault();
        state.realValue = state.realValue.slice(0, -1);
        input.value = '•'.repeat(state.realValue.length);
        input.setAttribute('vitecss-value', state.realValue);
        this.keepCursorAtEnd(input);
      } else if (e.key === 'Delete') {
        e.preventDefault();
        const cursorPos = input.selectionStart;
        const bulletCount = input.value.length;
        if (cursorPos < state.realValue.length) {
          state.realValue = state.realValue.slice(0, cursorPos) + state.realValue.slice(cursorPos + 1);
          input.value = '•'.repeat(state.realValue.length);
          input.setAttribute('vitecss-value', state.realValue);
          input.setSelectionRange(cursorPos, cursorPos);
        }
      }
    });
    
    input.addEventListener('click', () => this.keepCursorAtEnd(input));
    
    // Initialize
    input.value = '';
    input.setAttribute('vitecss-value', '');
    
    return input;
  }
  
  // Keep cursor at the end of input
  keepCursorAtEnd(input) {
    const len = input.value.length;
    input.setSelectionRange(len, len);
  }
  
  // Watch for dynamically added inputs
  observeNewInputs() {
    const observer = new MutationObserver((mutations) => {
      mutations.forEach((mutation) => {
        mutation.addedNodes.forEach((node) => {
          if (node.nodeType === 1) { // Element node
            if (node.matches && node.matches('input[vitecss-type="password"]')) {
              this.setupInput(node);
            }
            if (node.querySelectorAll) {
              const children = node.querySelectorAll('input[vitecss-type="password"]');
              children.forEach(child => this.setupInput(child));
            }
          }
        });
      });
    });
    
    observer.observe(document.body, { childList: true, subtree: true });
  }
  
  // Get all masked inputs
  getAllMaskedInputs() {
    return document.querySelectorAll('input[vitecss-type="password"]');
  }
}

// Initialize when DOM is ready
let maskUtility = null;

// Auto-initialize function
function initPasswordMask() {
  if (!maskUtility) {
    maskUtility = new PasswordMaskUtility();
  }
  return maskUtility;
}

// Export for different environments
if (typeof module !== 'undefined' && module.exports) {
  module.exports = { PasswordMaskUtility, initPasswordMask };
} else if (typeof window !== 'undefined') {
  window.PasswordMaskUtility = PasswordMaskUtility;
  window.initPasswordMask = initPasswordMask;
}

// post request
async function PostRequest(event,element,callback=null,btn_text=null){
  try{
      event.preventDefault();
 let inputs=element.querySelectorAll('.inp.required');
 
 
 let isEmpty = false;

 if(inputs){
    
    
    inputs.forEach((input)=>{
         let cont=input.closest('.cont');
        //  FIRST REMOVE EMPTY STATE
         if(cont){
         
        
            cont.classList.remove('empty');
           
           }else{
          
             input.classList.remove('empty');
            
           }
        //    CHECK FOR EMPTY INPUTS THAT ARE REQUIRED

        if(input.value.trim() == ''){
            isEmpty=true;
          
           
        if(cont){
            cont.classList.add('empty');
            
        }else{
              input.classList.add('empty');
        }
        }

    });
 }
 
 if(!isEmpty){
    // loading state
   let post_btn=element.querySelector('button');
   if(post_btn){
    let data_text=post_btn.dataset.text;
    if(!data_text){
        post_btn.dataset.text=post_btn.innerHTML;
    }
     post_btn.classList.toggle('disabled');
     post_btn.innerHTML=btn_text ?? 'Processing...';
   }


    let inps=element.querySelectorAll('.input');
    let form=new FormData();
    let val;
   
    inps.forEach((inp)=>{
        val=inp.value;
        if(inp.hasAttribute('vitecss-value')){
            val=inp.getAttribute('vitecss-value');
        }
       form.append(inp.name,val);

    });
    // check for photos
    let files=element.querySelectorAll('input[type=file]');
    if(files){
        files.forEach((inp)=>{
            let file=inp.files[0];
            if(file){
                form.append(inp.name,file);
            }
        })
    }

    
    let response=await fetch(element.action,{
        method : 'POST',
        body : form
     });
     
     if(response.ok){
        let data=await response.text();
        
        if(IsJSONABLE(data)){
            let json=JSON.parse(data);
            CreateNotify(json.status,json.message);
        }else{
            CreateNotify('error',data);
        }
        if(callback !== null){
            callback(data,event);
        }
       if(post_btn){
         post_btn.innerHTML=post_btn.dataset.text;
        post_btn.classList.toggle('disabled');
       }
     }else{
        if(post_btn){
         post_btn.innerHTML=post_btn.dataset.text;
        post_btn.classList.toggle('disabled');
       }
        CreateNotify('error','Internal Error: ' + response.status + ' Error');
        if(response.status == 419){
        window.location.reload();
    }
        
     }
     
 }
  }catch(error){
   HideActionLoader();
    CreateNotify('error',error);
    element.querySelector('button').classList.remove('active');
    
  }
}

//  hide prompt
function HidePrompt(){
    let conts=document.querySelectorAll('.cont.required');
  if(conts){
      conts.forEach((cont)=>{
        let inp=cont.querySelector('.input');
        inp.addEventListener('focus',()=>{
            conts.forEach((required)=>{
                required.querySelector('.prompt').style.display="none";
            })
        })
    })
  }
}

// create notify
function CreateNotify(status,message){
    let notifies=document.querySelectorAll('.notify');
    if(notifies){
        notifies.forEach((notify)=>{
            notify.remove();
        })
    }
  let section=document.createElement('section');
  section.classList.add('notify');
  section.classList.add(status);

  section.innerHTML=` <div class="row g-5 w-full p-5 body space-between align-center">
           
             <div class="column m-right-auto g-5">
              <strong style="text-transform:capitalize;" class="notify-status">
            ${status}
        </strong>
            <div class="message">
            ${message}
        </div>
             </div>
        <div onclick="HideNotify()" class="pc-pointer m-bottom-auto no-select" style="font-size:2rem">&times;</div>
        </div>`;
       
       
       
       
        document.body.appendChild(section);
        let RemoveNotify=setTimeout(()=>{
            section.remove();
        },5000);
    
}
function HideNotify(){
  let notify= document.querySelector('.notify');
    if(notify){
     notify.remove();
    }
}
// create notify 2
function CreateNotify2(status,message,data=null){
    let notify2=document.createElement('div');
    notify2.classList.add('notify2');
    let icon;
    let btn_text;
    let btn_function;
    if(data == null){
      btn_text='Understood';
      btn_function=function(){
        notify2.remove();
      }
    }else{
        btn_text = data.btn_text;
        btn_function=data.btn_function;
    }

    if(status == 'success'){
        icon=`<div class="c-green h-70 w-70 bg-green-transparent column justify-center circle">
        <svg width="50" height="50" viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12ZM16.0303 8.96967C16.3232 9.26256 16.3232 9.73744 16.0303 10.0303L11.0303 15.0303C10.7374 15.3232 10.2626 15.3232 9.96967 15.0303L7.96967 13.0303C7.67678 12.7374 7.67678 12.2626 7.96967 11.9697C8.26256 11.6768 8.73744 11.6768 9.03033 11.9697L10.5 13.4393L12.7348 11.2045L14.9697 8.96967C15.2626 8.67678 15.7374 8.67678 16.0303 8.96967Z" fill="CurrentColor"></path>
</svg>

    </div>`;
    }else{
        icon=` <div class="c-red h-70 w-70 bg-red-transparent column justify-center circle">
        <svg width="50" height="50" viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12ZM8.96963 8.96965C9.26252 8.67676 9.73739 8.67676 10.0303 8.96965L12 10.9393L13.9696 8.96967C14.2625 8.67678 14.7374 8.67678 15.0303 8.96967C15.3232 9.26256 15.3232 9.73744 15.0303 10.0303L13.0606 12L15.0303 13.9696C15.3232 14.2625 15.3232 14.7374 15.0303 15.0303C14.7374 15.3232 14.2625 15.3232 13.9696 15.0303L12 13.0607L10.0303 15.0303C9.73742 15.3232 9.26254 15.3232 8.96965 15.0303C8.67676 14.7374 8.67676 14.2625 8.96965 13.9697L10.9393 12L8.96963 10.0303C8.67673 9.73742 8.67673 9.26254 8.96963 8.96965Z" fill="CurrentColor"></path>
</svg>


    </div>`;
    }
    notify2.innerHTML=`
    <section  style="z-index:90000" class="notify2 column p-10 bg-black-transparent justify-center pos-fixed top-0 left-0 bottom-0 right-0 z-index-9000">
<div class="w-full child align-center max-w-500 column br-10 p-10 g-10 bg-light">
    ${icon}
    <strong class="desc">${status}</strong>
    <span>${message}</span>
    <span></span>
<div class="w-full action-btn no-shrink br-10 clip-10 pointer no-select bg-primary primary-text p-10 h-50 row justify-center">${btn_text}</div>

</div>
</section>
    `;
    notify2.querySelector('.action-btn').onclick=function(){
        btn_function();
    }
     document.body.classList.add('overflow-hidden');
    document.body.appendChild(notify2);
}
// hide notify 2
function HideNotify2(){
    document.querySelector('.notify-2').remove();
    document.body.classList.remove('overflow-hidden');
}
// get request
async function GetRequest(event,url,element=null,callback=null){
    try{
        event.preventDefault();
        if(element !== null){
            // WrapBtnText(element);
            // element.classList.add('active');
            // BtnLoader(element);
            ActionLoader();
        }
        let response=await fetch(url);
        if(response.ok){
           
            if(element !== null){
            // element.classList.remove('active');
        }
             if(callback !== null){
                callback(await response.text(),event);
            }
            HideActionLoader();
        } else{
            CreateNotify('error',response.status + ' Error');
           if(element !== null){
            // element.classList.remove('active');
        }
        }
    }catch(error){
        HideActionLoader();
        CreateNotify('error',error.stack);
       if(element !== null){
            // element.classList.remove('active');
        }
    }
}
// search request
async function SearchRequest(event,element,url,result){
    event.preventDefault();
    if(element.value == ''){
        result.classList.add('display-none');
    }else{

       
        let response=await fetch(url);
        if(response.ok){
           
            result.innerHTML=await response.text();
             result.classList.remove('display-none');
        }else{
             result.classList.remove('display-none');
            result.innerHTML=` <a class="row no-u text-dim clip-10 align-center g-5 space-between p-10">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#708090" viewBox="0 0 256 256"><path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216ZM80,108a12,12,0,1,1,12,12A12,12,0,0,1,80,108Zm96,0a12,12,0,1,1-12-12A12,12,0,0,1,176,108Zm-1.08,64a8,8,0,1,1-13.84,8c-7.47-12.91-19.21-20-33.08-20s-25.61,7.1-33.08,20a8,8,0,1,1-13.84-8c10.29-17.79,27.39-28,46.92-28S164.63,154.2,174.92,172Z"></path></svg>
                 <span class="m-right-auto">${response.status} Error</span>
                   </a>`
        }
    }
    
}
// copy
async function copy(data) {
    // Helper function for fallback copy (works on older iOS)
    function fallbackCopy(text) {
        const textarea = document.createElement('textarea');
        textarea.value = text;
        textarea.style.position = 'fixed';
        textarea.style.top = '-9999px';
        textarea.style.left = '-9999px';
        textarea.style.opacity = '0';
        document.body.appendChild(textarea);
        
        textarea.select();
        textarea.setSelectionRange(0, text.length);
        
        let success = false;
        
            success = document.execCommand('copy');
        
        
        document.body.removeChild(textarea);
        return success;
    }
    
   
        // Try modern Clipboard API first (newer iPhones iOS 13.4+)
        if (navigator.clipboard && window.isSecureContext && navigator.clipboard.writeText) {
            await navigator.clipboard.writeText(data);
            CreateNotify('success', 'Copied successfully');
        } 
        // Fallback for older iPhones (iOS 9-13.3)
        else {
            const success = fallbackCopy(data);
            if (success) {
                CreateNotify('success', 'Copied successfully');
            }
        }
    
}
// show popup
function PopUp(data=null){
    if(data !== null){
        document.querySelector('.popup .child').innerHTML=data;
    }
    document.querySelector('.popup').classList.add('active');
    document.body.classList.add('overflow-hidden');
    document.body.style.overflow="hidden";
}
// hide popup
function HidePopUp(callback=null){
   try{
     document.querySelector('.popup').classList.remove('active');
    document.body.classList.remove('overflow-hidden');
    document.body.style.overflow="auto";
    callback?.();
   }catch(error){
    CreateNotify('error',error.stack);
   }
}
// slideup
function SlideUp(content=null){
    if(content !== null){
        document.querySelector('.slideup .child').innerHTML=content;
    }
    document.querySelector('.slideup').classList.add('active');
    document.body.classList.add('overflow-hidden');
}
//  hide side up
function HideSlideUp(){
      document.querySelector('.slideup').classList.remove('active');
   document.body.classList.remove('overflow-hidden');
}
// stop propagation
function StopPropagation(event){
    event.stopPropagation();
}
// Infinite lloading
function InfiniteLoading(){
  
  let observer=new IntersectionObserver((entries)=>{
    entries.forEach(async (entry)=>{
        if(entry.isIntersecting){
          //  observer.unobserve(entry.target);
            let url=entry.target.dataset.url;
           
           
           let response=await fetch(url);
           if(response.ok){
            let data=await response.text();
         entry.target.outerHTML=data;
        
           //entry.target.remove();
        InfiniteLoading();
           }
        }
    })
  })
//   observe
let element=document.querySelector('.infinite-loading');
if(element){
    observer.observe(element);
}
}
// preview photo
function PreviewPhoto(element,label){
    let file=element.files[0];
    
    if(file){
        label.children[0].style.display='none';
        label.style.backgroundImage=`url('${URL.createObjectURL(file)}')`;
        label.classList.remove('bg');

    }else{
        label.style.backgroundImage='';
        label.children[0].style.display='flex';
         label.classList.add('bg');
    }

}
// hide loading
function HideLoading(){
    let loading=document.querySelector(".loading-state");
    if(loading){
        
        loading.remove()
        
    }
        
   

}
// set vh
function SetWindowHeight(){
    let height=window.innerHeight;
    document.body.style.minHeight=height + 'px';
}
// remove empty class from inputs and conts

function UnEmpty(){
    let inps=document.querySelectorAll('.inp.required');
 //   alert(10)
    if(inps){
        inps.forEach((inp)=>{
           inp.addEventListener('focus',()=>{
             let cont=inp.closest('.cont');
            if(cont){
                cont.classList.remove('empty');
            }else{
                inp.classList.remove('empty');
            }
           })
        })
    }
}


// Store cleanup functions for body-related items only
window._bodyCleanupFunctions = [];

// Register body-specific cleanup
function registerBodyCleanup(cleanupFn) {
    window._bodyCleanupFunctions.push(cleanupFn);
}

// Clean only body-related items before navigation
function cleanupBodyBeforeNavigate() {
    window._bodyCleanupFunctions.forEach(fn => {
        try {
            fn();
        } catch(e) {
            console.error('Body cleanup error:', e);
        }
    });
    window._bodyCleanupFunctions = [];
}

/**
 * SPA ENGINE WITH AUTOMATIC LIFECYCLE CLEANUP
 * -------------------------------------------
 * This script patches global browser functions to track and 
 * automatically remove listeners and timers between page loads.
 */

// 1. REGISTRY: Tracks all active page-level background processes
window.spaRegistry = {
    intervals: new Set(),
    timeouts: new Set(),
    listeners: [],

    // The "Nuke" function to wipe the slate clean
    cleanup() {
        // Clear all tracked intervals
        this.intervals.forEach(id => clearInterval(id));
        this.intervals.clear();

        // Clear all tracked timeouts
        this.timeouts.forEach(id => clearTimeout(id));
        this.timeouts.clear();

        // Remove all tracked event listeners
        this.listeners.forEach(({ target, type, fn, options }) => {
            target.removeEventListener(type, fn, options);
        });
        this.listeners = [];
        
        console.log("SPA: Cleanup complete. Intervals, timeouts, and listeners cleared.");
    }
};

// 2. MONKEY PATCHING: Intercept globals to auto-register them
const nativeInterval = window.setInterval;
const nativeTimeout = window.setTimeout;
const nativeAddListener = window.addEventListener;

window.setInterval = (fn, delay) => {
    const id = nativeInterval(fn, delay);
    window.spaRegistry.intervals.add(id);
    return id;
};

window.setTimeout = (fn, delay) => {
    const id = nativeTimeout(fn, delay);
    window.spaRegistry.timeouts.add(id);
    return id;
};

window.addEventListener = function(type, fn, options) {
    // We track listeners on window and document as they cause the most "leaks"
    if (this === window || this === document) {
        window.spaRegistry.listeners.push({ target: this, type, fn, options });
    }
    nativeAddListener.call(this, type, fn, options);
};

// 3. THE SPA FUNCTION: Handles navigation and surgical DOM updates
async function spa(url) {
    // Start Loading UI
    let bar = document.createElement('div');
    bar.classList.add('loading-bar');
    document.body.appendChild(bar);


    try {
        // Fire Start Events
        document.dispatchEvent(new Event('vitecss:navigate'));

        // Fetch new content
        const response = await fetch(url);
        if (!response.ok) throw new Error('Network response failed');
        
        const data = await response.text();
        const parser = new DOMParser();
        const doc = parser.parseFromString(data, 'text/html');
        // if(doc.querySelector('head').innerHTML != document.querySelector('head').innerHTML){
        //     window.location.href=url;
        //     return;
        // }
        // --- THE CLEANUP PHASE ---
        window.spaRegistry.cleanup();

        // --- THE UPDATE PHASE ---
        
        // Update Title
        document.title = doc.title;

        // Update Styles (Remove old .css styles, inject new ones)
        document.querySelectorAll('head style.css').forEach(s => s.remove());
        doc.querySelectorAll('head style.css').forEach(style => {
            const newStyle = document.createElement('style');
            newStyle.className = 'css';
            newStyle.textContent = style.textContent;
            document.head.appendChild(newStyle);
        });

        // Update Body Content
        document.body.innerHTML = doc.body.innerHTML;

        // Push to History
        history.pushState({ url }, doc.title, url);

        // --- THE RE-ACTIVATION PHASE ---
        
        // Find and re-execute scripts in the new body
        // (Native innerHTML injection doesn't execute <script> tags)
        document.body.querySelectorAll('script').forEach(oldScript => {
            const newScript = document.createElement('script');
            
            // Copy all attributes (src, type, etc.)
            Array.from(oldScript.attributes).forEach(attr => {
                newScript.setAttribute(attr.name, attr.value);
            });
            
            // Copy script content
            newScript.textContent = oldScript.textContent;
            
            // Replace to trigger execution
            oldScript.parentNode.replaceChild(newScript, oldScript);
        });

        // Fire Success Event
        document.dispatchEvent(new Event('vitecss:navigated'));

    } catch (error) {
        console.error('SPA Error:', error);
        document.dispatchEvent(new Event('vitecss:navigate-error'));
         window.location.href=url;
    } finally {
        // Remove Loading UI
        if (bar.parentNode) bar.remove();
       
    }
}

// 4. BROWSER BACK/FORWARD SUPPORT
window.onpopstate = function(event) {
    if (event.state && event.state.url) {
        spa(event.state.url);
    }
};

// Vitecss
window.Vitecss = {
    navigate : (url)=>{
        spa(url)
    }
}
// toggle nav group
function ToggleNavGroup(element){
    let group=element.closest('.group');
    if(group.classList.contains('active')){
 group.classList.remove('active');
    }else{
         group.classList.add('active');
    }
   
}
// toggle nav
function ToggleNav(){
    document.querySelector('nav').classList.add('active');
}
// Hide nav
function HideNav(){
    document.querySelector('nav').classList.remove('active');
}
// auto fill
function AutoFill(val,input,element){
   // alert(10)
   input.value=val;
   if(element !== null){
    element.classList.add('active');
   }


}
// calling functions
function GeneralStyles(){
      document.querySelector('.loading-state').remove();
      
}
// loaded
function Loaded(){
    document.querySelectorAll('[data-onload]').forEach((data)=>{
        let element=data;
        eval(data.getAttribute('data-onload'));
    });
}

window.addEventListener('load',()=>{
    GeneralStyles();
    SetWindowHeight();
    UnEmpty();
    Loaded();
    CustomMarquee();
    initPasswordMask();
    
});



// vitecss navigated
document.addEventListener('vitecss:navigated',()=>{
    GeneralStyles();
    SetWindowHeight();
    UnEmpty();
    Loaded();
    CustomMarquee();
    initPasswordMask();

});
 
 


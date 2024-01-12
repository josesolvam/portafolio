const E=document.querySelector("body"),k=document.querySelector("#menu-movil"),Q=document.querySelector("#navegacion-principal"),g=document.querySelector("#sidebar"),L=document.querySelector("main"),D=document.querySelector("#menu-icon"),I=document.querySelector("#close-menu-icon"),F=document.querySelector("#nombre"),N=document.querySelector("#telefono"),W=document.querySelector("#correo"),X=document.querySelector("#mensaje"),$=document.querySelector("#formulario"),H=document.querySelector('#formulario button[type="submit"]'),Y=document.querySelector("#errores-contacto"),K=document.querySelector("#exito-contacto"),T=document.querySelectorAll(".fade-in"),Z=document.querySelector("#proyectos"),ee=document.querySelector("#error-fetch-proyectos"),ne=document.querySelector("#proyecto"),oe=document.querySelector("#error-fetch-proyecto"),i=document.createElement("DIV");function U(){P(),J()}function P(){i.setAttribute("id","overlay"),i.style.display="none",i.style.backgroundColor="rgba(0,0,0,0)",i.style.position="fixed",i.style.width="100%",i.style.height="100%",i.style.top="0",i.style.left="0",i.style.zIndex="-1",document.body.appendChild(i)}function J(){D.addEventListener("click",j),I.addEventListener("click",_),i.addEventListener("click",_),window.addEventListener("scroll",function(){L.getBoundingClientRect().top<0?(k.style.backgroundColor="var(--primario)",Q.style.backgroundColor="var(--primario)",g.style.backgroundColor="var(--primario)"):(k.style.backgroundColor="var(--indigo-oscuro)",Q.style.backgroundColor="var(--indigo-oscuro)",g.style.backgroundColor="var(--indigo-oscuro)")})}function j(){E.classList.add("block-scroll"),g.style.width="25rem",i.style.display="block",i.style.zIndex="2",i.style.backgroundColor="rgba(0,0,0,0.6)"}function _(){E.classList.remove("block-scroll"),g.style.width="0",i.style.backgroundColor="rgba(0,0,0,0)",i.style.display="none",i.style.zIndex="-1"}let y=[];T.forEach(l=>{y.push(l)});function M(){G()}function G(){V(y),window.addEventListener("scroll",function(){O(y)})}function V(l){y=l.map(c=>c&&(c.style.opacity="0",c.getBoundingClientRect().top<window.innerHeight-40)?(c.style.opacity="1",null):c)}function O(l){y=l.map(c=>c&&c.getBoundingClientRect().top<window.innerHeight-40?(c.classList.add("apply-fade-in"),null):c)}/*! modernizr 3.6.0 (Custom Build) | MIT *
 * https://modernizr.com/download/?-webp-setclasses !*/(function(l,c,z){function p(n,e){return typeof n===e}function x(){var n,e,r,t,a,f,s;for(var A in d)if(d.hasOwnProperty(A)){if(n=[],e=d[A],e.name&&(n.push(e.name.toLowerCase()),e.options&&e.options.aliases&&e.options.aliases.length))for(r=0;r<e.options.aliases.length;r++)n.push(e.options.aliases[r].toLowerCase());for(t=p(e.fn,"function")?e.fn():e.fn,a=0;a<n.length;a++)f=n[a],s=f.split("."),s.length===1?o[s[0]]=t:(!o[s[0]]||o[s[0]]instanceof Boolean||(o[s[0]]=new Boolean(o[s[0]])),o[s[0]][s[1]]=t),C.push((t?"":"no-")+s.join("-"))}}function S(n){var e=m.className,r=o._config.classPrefix||"";if(q&&(e=e.baseVal),o._config.enableJSClass){var t=new RegExp("(^|\\s)"+r+"no-js(\\s|$)");e=e.replace(t,"$1"+r+"js$2")}o._config.enableClasses&&(e+=" "+r+n.join(" "+r),q?m.className.baseVal=e:m.className=e)}function b(n,e){if(typeof n=="object")for(var r in n)B(n,r)&&b(r,n[r]);else{n=n.toLowerCase();var t=n.split("."),a=o[t[0]];if(t.length==2&&(a=a[t[1]]),typeof a<"u")return o;e=typeof e=="function"?e():e,t.length==1?o[t[0]]=e:(!o[t[0]]||o[t[0]]instanceof Boolean||(o[t[0]]=new Boolean(o[t[0]])),o[t[0]][t[1]]=e),S([(e&&e!=0?"":"no-")+t.join("-")]),o._trigger(n,e)}return o}var C=[],d=[],u={_version:"3.6.0",_config:{classPrefix:"",enableClasses:!0,enableJSClass:!0,usePrefixes:!0},_q:[],on:function(n,e){var r=this;setTimeout(function(){e(r[n])},0)},addTest:function(n,e,r){d.push({name:n,fn:e,options:r})},addAsyncTest:function(n){d.push({name:null,fn:n})}},o=function(){};o.prototype=u,o=new o;var B,m=c.documentElement,q=m.nodeName.toLowerCase()==="svg";(function(){var n={}.hasOwnProperty;B=p(n,"undefined")||p(n.call,"undefined")?function(e,r){return r in e&&p(e.constructor.prototype[r],"undefined")}:function(e,r){return n.call(e,r)}})(),u._l={},u.on=function(n,e){this._l[n]||(this._l[n]=[]),this._l[n].push(e),o.hasOwnProperty(n)&&setTimeout(function(){o._trigger(n,o[n])},0)},u._trigger=function(n,e){if(this._l[n]){var r=this._l[n];setTimeout(function(){var t;for(t=0;t<r.length;t++)r[t](e)},0),delete this._l[n]}},o._q.push(function(){u.addTest=b}),o.addAsyncTest(function(){function n(t,a,f){function s(v){var w=v&&v.type==="load"?A.width==1:!1,R=t==="webp";b(t,R&&w?new Boolean(w):w),f&&f(v)}var A=new Image;A.onerror=s,A.onload=s,A.src=a}var e=[{uri:"data:image/webp;base64,UklGRiQAAABXRUJQVlA4IBgAAAAwAQCdASoBAAEAAwA0JaQAA3AA/vuUAAA=",name:"webp"},{uri:"data:image/webp;base64,UklGRkoAAABXRUJQVlA4WAoAAAAQAAAAAAAAAAAAQUxQSAwAAAABBxAR/Q9ERP8DAABWUDggGAAAADABAJ0BKgEAAQADADQlpAADcAD++/1QAA==",name:"webp.alpha"},{uri:"data:image/webp;base64,UklGRlIAAABXRUJQVlA4WAoAAAASAAAAAAAAAAAAQU5JTQYAAAD/////AABBTk1GJgAAAAAAAAAAAAAAAAAAAGQAAABWUDhMDQAAAC8AAAAQBxAREYiI/gcA",name:"webp.animation"},{uri:"data:image/webp;base64,UklGRh4AAABXRUJQVlA4TBEAAAAvAAAAAAfQ//73v/+BiOh/AAA=",name:"webp.lossless"}],r=e.shift();n(r.name,r.uri,function(t){if(t&&t.type==="load")for(var a=0;a<e.length;a++)n(e[a].name,e[a].uri)})}),x(),S(C),delete u.addTest,delete u.addAsyncTest;for(var h=0;h<o._q.length;h++)o._q[h]();l.Modernizr=o})(window,document);document.addEventListener("DOMContentLoaded",function(){U(),M()});export{ne as a,oe as b,Z as c,F as d,ee as e,N as f,X as g,$ as h,W as i,H as j,Y as k,K as l};

import{s as A,M as m,m as u,t as C,u as T,v as L,w as P,x as w,y as b}from"./main.bdTi7Vbw.js";import{c as D,U as $}from"./consts.xUzxqWeM.js";const M={src:"/portafolio/_astro/ti-edit.1aLhNrhT.svg",width:40,height:40,format:"svg"},N={src:"/portafolio/_astro/ti-trash.OjuYDIvh.svg",width:40,height:40,format:"svg"},v="http://localhost/portafolio/imagenes",l="http://localhost/portafolio";D();document.addEventListener("DOMContentLoaded",function(){O()});async function O(){try{const t=await A();R(t.resultado.proyectos)}catch(t){let e;t instanceof m?e=JSON.parse(t.message):e=["Error"],u("error",b,e)}}function R(t){if(!t.length)throw new m(JSON.stringify(["No hay registros"]));t.forEach(e=>{const{id:o,titulo:h,descripcion:g,imagen:p,fechaProyecto:S}=e,r=document.createElement("TR");r.classList.add("entrada-proyectos");const n=document.createElement("TD");n.classList.add("acciones");const a=document.createElement("A");a.classList.add("boton","boton-primario","w-100"),a.setAttribute("href",`${l}/admin/proyecto/#/${$.EDITAR_PROYECTO}/${o}`),a.innerHTML=`<img src=${M.src} alt="icono editar" />`;const s=document.createElement("SPAN");s.classList.add("boton","boton-rojo","w-100"),s.innerHTML=`<img src=${N.src} alt="icono eliminar" />`,s.onclick=function(){I(o)},n.appendChild(a),n.appendChild(s),r.appendChild(n);const f=document.createElement("TD");f.textContent=o,r.appendChild(f);const y=document.createElement("TD");y.textContent=h,r.appendChild(y);const i=document.createElement("TD");i.classList.add("descripcion-proyecto"),i.textContent=g,r.appendChild(i);const d=document.createElement("TD");d.classList.add("imagen-proyecto");const c=document.createElement("IMG"),E=p.length?`${v}/${p}`:`${l}/img/no-img.png`;c.setAttribute("src",E),c.setAttribute("alt",`imagen de ${h}`),c.setAttribute("loading","lazy"),d.appendChild(c),r.appendChild(d),C.appendChild(r),T.style.display="block"})}async function I(t){try{if((await L()).isConfirmed){const o=await P(t);window.location.href=`${l}/admin`}}catch(e){let o;e instanceof m?o=JSON.parse(e.message):o=["Error"],u("error",w,o,"alerta-error-form")}}

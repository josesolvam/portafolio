import{c as g,e as E}from"./hoisted.RG0r74SF.js";import{f as P,M as m,m as L}from"./alertas.c_6jZo2R.js";const C="http://localhost/portafolio/imagenes",p="http://localhost/portafolio";document.addEventListener("DOMContentLoaded",function(){I()});async function I(){try{const t=await P();$(t.resultado.proyectos)}catch(t){let e;t instanceof m?e=JSON.parse(t.message):e=["Error"],L("error",E,e)}}function $(t){if(!t.length)throw new m(JSON.stringify(["No hay registros"]));t.forEach(e=>{const{id:y,titulo:d,descripcion:h,imagen:l,fechaProyecto:f}=e,o=document.createElement("ARTICLE");o.classList.add("entrada-proyectos","fade-in");const n=document.createElement("DIV");n.classList.add("imagen-proyecto");const r=document.createElement("IMG"),u=l.length?`${C}/${l}`:`${p}/img/no-img.png`;r.setAttribute("src",`${u}`),r.setAttribute("alt",`imagen de ${d}`),r.setAttribute("loading","lazy"),n.appendChild(r);const c=document.createElement("DIV");c.classList.add("texto-proyecto");const a=document.createElement("H3");a.classList.add("titulo-proyecto"),a.textContent=d;const s=document.createElement("P");s.classList.add("fecha-proyecto"),s.innerHTML=`Fecha proyecto: <span>${f}</span>`;const i=document.createElement("P");i.classList.add("descripcion-proyecto"),i.textContent=h,c.appendChild(a),c.appendChild(s),c.appendChild(i),o.appendChild(n),o.appendChild(c),o.onclick=function(){location.href=`${p}/proyecto/#/${y}`},g.appendChild(o)})}
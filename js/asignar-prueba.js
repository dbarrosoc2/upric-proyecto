function MultiselectDropdown(options){
    function newEl(tag,attrs){
      var e=document.createElement(tag);
      if(attrs!==undefined) Object.keys(attrs).forEach(k=>{
        if(k==='class') { Array.isArray(attrs[k]) ? attrs[k].forEach(o=>o!==''?e.classList.add(o):0) : (attrs[k]!==''?e.classList.add(attrs[k]):0)}
        else if(k==='style'){  
          Object.keys(attrs[k]).forEach(ks=>{
            e.style[ks]=attrs[k][ks];
          });
         }
        else if(k==='text'){attrs[k]===''?e.innerHTML='&nbsp;':e.innerText=attrs[k]}
        else e[k]=attrs[k];
      });
      return e;
    }
  
    
    document.querySelectorAll("select[multiple]").forEach((el,k)=>{
      var div=newEl('div',{class:'multiselect-dropdown'});
      el.style.display='none';
      el.parentNode.insertBefore(div,el.nextSibling);
      var listWrap=newEl('div',{class:'multiselect-dropdown-list-wrapper'});
      var list=newEl('div',{class:'multiselect-dropdown-list'});
      var search=newEl('input',{class:['multiselect-dropdown-search'].concat(['form-control']),style:{width:'100%',display:el.attributes['multiselect-search']?.value==='true'?'block':'none'},placeholder:"Buscar prueba"});
      listWrap.appendChild(search);
      div.appendChild(listWrap);
      listWrap.appendChild(list);
  
      el.loadOptions=()=>{
        list.innerHTML='';
        
        if(el.attributes['multiselect-select-all']?.value=='true'){
          var op=newEl('div',{class:'multiselect-dropdown-all-selector'})
          var ic=newEl('input',{type:'checkbox'});
          op.appendChild(ic);
    
          op.addEventListener('click',()=>{
            op.classList.toggle('checked');
            op.querySelector("input").checked=!op.querySelector("input").checked;
            
            var ch=op.querySelector("input").checked;
            list.querySelectorAll(":scope > div:not(.multiselect-dropdown-all-selector)")
              .forEach(i=>{if(i.style.display!=='none'){i.querySelector("input").checked=ch; i.optEl.selected=ch}});
    
            el.dispatchEvent(new Event('change'));
          });
          ic.addEventListener('click',(ev)=>{
            ic.checked=!ic.checked;
          });
          el.addEventListener('change', (ev)=>{
            let itms=Array.from(list.querySelectorAll(":scope > div:not(.multiselect-dropdown-all-selector)")).filter(e=>e.style.display!=='none')
            let existsNotSelected=itms.find(i=>!i.querySelector("input").checked);
            if(ic.checked && existsNotSelected) ic.checked=false;
            else if(ic.checked==false && existsNotSelected===undefined) ic.checked=true;
          });
    
          list.appendChild(op);
        }
  
        Array.from(el.options).map(o=>{
          var op=newEl('div',{class:o.selected?'checked':'',optEl:o})
          var ic=newEl('input',{type:'checkbox',checked:o.selected});
          op.appendChild(ic);
          op.appendChild(newEl('label',{text:o.text}));
  
          op.addEventListener('click',()=>{
            op.classList.toggle('checked');
            op.querySelector("input").checked=!op.querySelector("input").checked;
            op.optEl.selected=!!!op.optEl.selected;
            el.dispatchEvent(new Event('change'));
          });
          ic.addEventListener('click',(ev)=>{
            ic.checked=!ic.checked;
          });
          o.listitemEl=op;
          list.appendChild(op);
        });
        div.listEl=listWrap;
  
        div.refresh=()=>{
          div.querySelectorAll('span.optext, span.placeholder').forEach(t=>div.removeChild(t));
          var sels=Array.from(el.selectedOptions);
            sels.map(x=>{
                var c=newEl('span',{class:'optext',text:x.text, srcOption: x});
                if((el.attributes['multiselect-hide-x']?.value !== 'true'))
                c.appendChild(newEl('span',{class:'optdel',text:'🗙',  onclick:(ev)=>{c.srcOption.listitemEl.dispatchEvent(new Event('click'));div.refresh();ev.stopPropagation();}}));

                div.appendChild(c);
            });
        };
        div.refresh();
      }
      el.loadOptions();
      
      search.addEventListener('input',()=>{
        list.querySelectorAll(":scope div:not(.multiselect-dropdown-all-selector)").forEach(d=>{
          var txt=d.querySelector("label").innerText.toUpperCase();
          d.style.display=txt.includes(search.value.toUpperCase())?'block':'none';
        });
      });
  
      div.addEventListener('click',()=>{
        div.listEl.style.display='block';
        search.focus();
        search.select();
      });
      
      document.addEventListener('click', function(event) {
        if (!div.contains(event.target)) {
          listWrap.style.display='none';
          div.refresh();
        }
      });    
    });

    document.querySelector(".placeholderLoading").classList.add("d-none");
    document.querySelector("form").classList.remove("d-none");
  }
  
  window.addEventListener('load',()=>{
    MultiselectDropdown(window.MultiselectDropdownOptions);
  });
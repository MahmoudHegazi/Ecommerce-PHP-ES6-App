// Control Table using Javascript (This Plugin Super Fast and preformance friendly)
// This solution Very Fast and 600% preformance instead of use queries and requests to order data
window.addEventListener('DOMContentLoaded', (event) => {

   // my logic to get current page like advanced SCRIPT_NAME in php handle query paramters
   const currentPage = window.location.href.split('/')[window.location.href.split('/').length -1].split('?')[0];
    // global vars
  const rows = document.querySelectorAll(".datarow");

  let table = '';
  let enable_plugin = true;

  if (rows.length > 0) {


const handle_pages_vars = async ()=> {
    switch(currentPage) {
  case "tasks_read.php":
    /* ** tasks ** */
    table = "tasks_table";
    const tTaskNames = document.querySelectorAll(".tasks_taskname");
    const tTaskDurations = document.querySelectorAll(".tasks_duration");
    const tTaskStarts = document.querySelectorAll(".tasks_start");
    const tTaskFinish = document.querySelectorAll(".tasks_finish");
    return table;
    break;
  case "cost_read.php":
    /* ** cost ** */
    table = "cost_table";
    const cResourceNames = document.querySelectorAll(".cost_resource_name");
    const cTypes = document.querySelectorAll(".cost_type");
    const cMaterial_maxs = document.querySelectorAll(".cost_material_max");
    const cStRates = document.querySelectorAll(".cost_st_rate");
    const cOvts = document.querySelectorAll(".cost_ovt");
    return table;
    break;
  case "allocate_read.php":
    /* ** allocate ** */
    table = "allocate_table";
    const aTaskName = document.querySelectorAll(".taskname_allocate");
    const aDurations = document.querySelectorAll(".duration_allocate");
    const aStarts = document.querySelectorAll(".start_allocate");
    const aFinishs = document.querySelectorAll(".finish_allocate");
    const aResources = document.querySelectorAll(".resource_allocate");
    return table;
    break;
    case "cost_pertask.php":
      /* ** costpertask ** */
      table = "costspertask_table";
      const cptIds = document.querySelectorAll(".costpertask_id");
      const cptTaskNames = document.querySelectorAll(".costpertask_taskname");
      const cptDurations = document.querySelectorAll(".costpertask_duration");
      const cptStarts = document.querySelectorAll(".costpertask_start");
      const cptFinishs = document.querySelectorAll(".costpertask_finish");
      const cptResourceNames = document.querySelectorAll(".costpertask_resource_name");
      const cptCosts = document.querySelectorAll(".costpertask_cost");
      //break;
      return table;
      break;

      case "totalproject_cost.php":
        /* ** costpertask ** */
        table = "totalproject_table";
        //break;
        return table;
        break;
  default:
    table = false;
    return 'false';
    }

  }
 var toggle_value = true;
 const toggle_mode = (currenttds)=> {
  const darkmode = (td_objnodelist)=> {
    td_objnodelist.forEach( (small_td)=>{
       small_td.classList.add('dark');
    });
  }

  const normalmode = (td_objnodelist)=> {
    td_objnodelist.forEach( (small_td)=>{
       small_td.classList.remove('dark');
    });

  }

  if (toggle_value == true){
    darkmode(currenttds);
    toggle_value = false;
  } else {
    normalmode(currenttds);
    toggle_value = true;
  }

  }

   // when the variables Declared and loaded we can start our Heavy process nextSibling
   handle_pages_vars().then( (current_page_table)=> {
      if (table === false){
        console.log('table plugin disabled');
        return false;
      }


       // get the current table viewed By User Dynamic
        const current_table = document.querySelector(`#${current_page_table}`);

        const downloadbtn = document.querySelector(`.mymain .excelbtn`);

        const currenttds = document.querySelectorAll(`#${current_page_table} td`);

        // dynamic idenyify table columns names
        const colmnnames = document.querySelectorAll(`#${current_page_table} th`);



        // Create the Setting menue With JS

        const settings_menu = document.createElement("div");
        settings_menu.setAttribute("class", "settings_container");

        const checkbox_menu = document.createElement("div");
        checkbox_menu.setAttribute("class", "settings_container1");


        // function to hide columns
        //let columnclass_list = [];
        //colmnnames.forEach( (col)=>{ columnclass_list.push(col.getAttribute('class')); } );
        //alert(columnclass_list);

         // this function to handle show and hide checked  Columns
        const handleColumnRender = (event)=> {
          let ischecked =  document.getElementById(event.target.getAttribute('id')).checked;
          let colmn_value = document.getElementById(event.target.getAttribute('id')).getAttribute('value');
          let column_tds = document.querySelectorAll(`.${colmn_value}`);

          if (!ischecked) {
              column_tds.forEach( (one_td)=>{
                one_td.classList.add('hidetd');
              });
            } else {
              column_tds.forEach( (one_td)=>{
                  one_td.classList.remove('hidetd');
              });
            }

        }

        let checkbox_fragment = document.createDocumentFragment();

        colmnnames.forEach( (col_elm, index)=>{
           let col_class = col_elm.getAttribute('class');
           let colid = col_elm.getAttribute('id');
           let colhead = col_elm.innerText;
           let newcheck = document.createElement('input');
           newcheck.setAttribute("type", 'checkbox');
           newcheck.setAttribute("class", 'settings_check');
           newcheck.setAttribute("checked", 'checked');
           newcheck.setAttribute("data-column-class", col_class);
           newcheck.setAttribute("value", col_class);
           newcheck.setAttribute("id", `${col_class}_input`);
           newcheck.setAttribute("name", col_class);
           newcheck.addEventListener("click", handleColumnRender);
           let newlabel = document.createElement('label');
           let labeltext = document.createTextNode(` ${colhead}: `);
           newlabel.setAttribute("for", col_class);
           newlabel.setAttribute("class", 'checklabel');
           newlabel.appendChild(labeltext);
           checkbox_fragment.appendChild(newlabel);
           checkbox_fragment.appendChild(newcheck);
        });
        checkbox_menu.appendChild(checkbox_fragment);

        let newdiv1 = document.createElement('div');
        newdiv1.setAttribute('style', 'display:block;margin-top:5px;');

        const getSearch = (event)=> {
           if (event.target.checked) {
             newsearch.removeAttribute("disabled");
             // start search
             applylistener(newsearch);
           } else {
             newsearch.setAttribute("disabled", "disabled");
             newsearch.value = '';
           }
           //rowSearch(event.target.checked);
        }
        // search function
        const applylistener = async (element)=> {
          element.addEventListener('input', ()=> { return rowSearch(element.value);})

        }
        main_color = currenttds[0].style.backgroundColor;
        const rowSearch = async (value) => {
          darkenabled = false;
          const functionstorage = [];
          const alltds_texts = [];
          let results = [];
          let results_indexs = [];
          currenttds.forEach( (saved_text, index)=>{
            if (index == 0){
              if (saved_text.classList.contains('dark')){
                darkenabled = true;
              } else {
                darkenabled = false;
              }
            }
            let keysearch = saved_text.textContent;
            var resultindex = 0;
            let basicvalue = value.toLowerCase();
            let basicsaved = keysearch.toLowerCase();
            if ( basicvalue == basicsaved ) {
              results.push(saved_text);
              results_indexs.push(index);
            }

            for (var i=0; i<value.length; i++){
              if (i > keysearch.length){
                break;
              }
              if (value[i] == keysearch[i]){
                resultindex += 1;
              }

            }

            // if more than 50% of text it's vald
            if ((resultindex >= (value.length - value.length) + (value.length * 90 / 100)) && value.length > 0) {
              results.push(saved_text);
              results_indexs.push(index);
              console.log('Ideal with precentage ' + ((value.length * 70) / 100))
              console.log('AI search key recongezed');

            }

          });

          currenttds.forEach( (rvalid)=>{
            rvalid.style.background = main_color;
            if (darkenabled){
              rvalid.style.background = '#090b11';
            }
          })
             results.forEach( (valid)=>{
               valid.style.background = "gold";
             })
            return true;
        }

        let newsearch = document.createElement('input');
        let newsearchchec = document.createElement('input');
        let newlabelsearch = document.createElement('label');
        newsearch.setAttribute("type", 'text');
        newsearch.setAttribute("id", 'searchinpt');
        newsearch.setAttribute("disabled", 'true');
        newlabelsearch.innerText = "Enable Search";
        newsearchchec.setAttribute("id", 'searchcheck');
        newsearchchec.setAttribute("type", 'checkbox');
        newsearchchec.addEventListener('change',getSearch )

        newdiv1.appendChild(newsearch);
        newdiv1.appendChild(newsearchchec);
        newdiv1.appendChild(newlabelsearch);

        console.log(current_table.parentElement)
        current_table.parentElement.insertBefore(newdiv1,current_table);




        // dark mode btn
        const darkmode_btn = document.createElement("button");
        darkmode_btn.setAttribute("class", "settings_btn");
        darkmode_btn.addEventListener("click", ()=> {toggle_mode(currenttds);});
        darkmode_btn.textContent = "Dark Mode";

        // js pagination
        const pagination_min = document.createElement("input");
        const pagination_max = document.createElement("input");
        pagination_min.setAttribute("class", "settings_inpt");
        pagination_min.setAttribute("type", "number");
        pagination_min.setAttribute("placeholder", "Min");
        pagination_min.setAttribute("min", 1);
        pagination_min.setAttribute("max", rows.length - 1);
        pagination_min.addEventListener("input", ()=> {show_rows_limit(pagination_min, pagination_max);});

        pagination_max.setAttribute("class", "settings_inpt");
        pagination_max.setAttribute("type", "number");
        pagination_max.setAttribute("placeholder", "Max");
        pagination_max.setAttribute("min", 1);
        pagination_max.setAttribute("max", rows.length);
        pagination_max.addEventListener("input", ()=> {show_rows_limit(pagination_min, pagination_max);});

        const current_rows_showns = [];

        const clear_class = (objnodelist, classname)=> {
          objnodelist.forEach( (elm)=> {
            elm.classList.remove(classname);
          });
        };

        // function to controll the rendered recoreds using js
        const show_rows_limit = (start, end)=> {
        // handle if empty values
        let start_value, end_value;

        if (start.value == '' && end.value == ''){
           start_value = 1;
           clear_class(rows, 'classhide');
           return false;
        } else {
          start_value = start.value;
          end_value = end.value;
        }

        if (start.value == '' && end.value != ''){
           start_value = 1;
        } else if (start.value > rows.length){
           start_value = rows.length;
        } else {
           start_value = start.value;
        }


        if ( end.value == '' && start.value != ''){
           end_value = rows.length;
        } else {
           end_value = end.value;
        }



        for (var i=0; i < rows.length; i++) {




          if (i >= (start_value-1) && i < end_value) {
            current_rows_showns.push(rows[i]);
            rows[i].classList.remove('classhide');
          } else {
            rows[i].classList.add('classhide');
          }

        };
        return true;
        }

        settings_menu.appendChild(darkmode_btn);
        settings_menu.appendChild(pagination_min);
        settings_menu.appendChild(pagination_max);

        if (table = 'totalproject_table'){
          document.querySelector(".mymain").insertBefore(settings_menu, document.querySelector(".the_hr").nextSibling);
          document.querySelector(".mymain").insertBefore(checkbox_menu, settings_menu);
      } else {
        current_table.parentElement.insertBefore(settings_menu, downloadbtn);
        current_table.parentElement.insertBefore(checkbox_menu, downloadbtn.nextSibling);
      }
    });





    }

});

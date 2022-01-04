async function getPosts(){
    let res = await fetch('http://restapi/restapi/tasks');
    let tasks = await res.json();

    document.querySelector('.task-list').innerHTML ='';

    tasks.forEach((task)=>{
  document.querySelector('.task-list').innerHTML +=`
      <div class="card" style="width: 18rem;">
                    <div class="card-body">
                       <h5 class="card-title">${task.name}</h5>
                       <p>${task.description}</p>                       
                       <a href="#" class="card-link" onclick="viewTask(${task.id})"> View task</a>
                       <a href="#"  class="card-link" onclick="removeTask(${task.id})">Delete task</a>
                   </div>
                  </div>`

    })
}

async function addTask(){
    const name = document.getElementById('taskName').value,
        description = document.getElementById('taskDescription').value;

    let formData = new FormData();
    formData.append('name',name);
    formData.append('description',description);

    const res = await fetch('http://restapi/restapi/tasks',{
        method: 'POST',
        body: formData
    });

    const data = await res.json();
    if (data.status === true){
       await getPosts();
    }


}
async function removeTask(id) {
    const res = await fetch(`http://restapi/restapi/tasks/${id}`, {
        method: "DELETE"
    });
    const data = await res.json();
    if (data.status === true) {
        await getPosts();
    }

}
async function viewTask(id) {
    const res = await fetch(`http://restapi/restapi/tasks/${id}`, {
        method: "GET"
    });
    let tasks = await res.json();

    document.querySelector('.task-list').innerHTML ='';

   if (!Array.isArray(tasks)){
           document.querySelector('.task-list').innerHTML +=`
                  <div class="card" style="width: 18rem;">
                    <div class="card-body">
                       <p>Task specification</p>
                       <h5 class="card-title"> ${tasks.name}</h5>
                       <h6>${tasks.description}</h6>  
                       <p>Tegs:  ${tasks.tName}</p>   
                   </div>
                  </div>`


   }else {

       let tags = '';
       tasks.forEach((task)=>{
           tags +=  task.tName+ ', ';
       })
       document.querySelector('.task-list').innerHTML +=`
                  <div class="card" style="width: 18rem;">
                    <div class="card-body">
                       <p>Task specification</p>
                       <h5 class="card-title"> ${tasks[0].name}</h5>
                       <h6>${tasks[0].description}</h6>  
                       <p>Tegs:  ${tags}</p>   
                   </div>
                  </div>`


   }
}






async function getTags(){
    let res = await fetch('http://restapi/restapi/tags');
    let tags = await res.json();

    document.querySelector('.tag-list').innerHTML ='';

    tags.forEach((tag)=>{
        document.querySelector('.tag-list').innerHTML +=`
      <div class="card" style="width: 18rem;">
                    <div class="card-body">
                       <h5 class="card-title">${tag.name}</h5>
                                          
                       <a href="#" class="card-link" onclick="viewTag(${tag.id})"> View tag</a>
                       <a href="#"  class="card-link" onclick="removeTag(${tag.id})">Delete tag</a>
                   </div>
                  </div>`

    })
}

async function addTag(){
    const name = document.getElementById('tagName').value;

    let formData = new FormData();
    formData.append('name',name);

    const res = await fetch('http://restapi/restapi/tags',{
        method: 'POST',
        body: formData
    });

    const data = await res.json();
    if (data.status === true){
        await getTags();
    }

}
async function removeTag(id) {
    const res = await fetch(`http://restapi/restapi/tags/${id}`, {
        method: "DELETE"
    });
    const data = await res.json();
    if (data.status === true) {
        await getTags();
    }

}

async function viewTag(id) {
    const res = await fetch(`http://restapi/restapi/tags/${id}`, {
        method: "GET"
    });
    let tags = await res.json();

    document.querySelector('.tag-list').innerHTML ='';

    if (!Array.isArray(tags)){
        document.querySelector('.tag-list').innerHTML +=`
                  <div class="card" style="width: 18rem;">
                    <div class="card-body">
                       <p>Tag specification</p>
                       <h5 class="card-title"> ${tags.name}</h5>                      
                       <p>Tasks:  ${tags.tName}</p>   
                   </div>
                  </div>`
    }else {

        let tasks = '';
        tags.forEach((tag)=>{
            tasks +=  tag.tName+ ', ';
        })
        document.querySelector('.tag-list').innerHTML +=`
                  <div class="card" style="width: 18rem;">
                    <div class="card-body">
                       <p>Tag specification</p>
                       <h5 class="card-title"> ${tags[0].name}</h5>                      
                       <p>Tasks:  ${tasks}</p>   
                   </div>
                  </div>`


    }
}



getTags();
getPosts();
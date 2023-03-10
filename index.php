<?php include('db.php') ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TodoList</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<body>

    <div class="title">
        ToDo List | Lista de tareas
    </div>
    <form action="">
        <div class="top-buttons">
            <button type="button" onclick="switchTask()">Añadir tarea</button>
            <div id="add-taskMenu" class="add-task" style='display:none;'>
                <div class="inputs-box">
                    <div class="section-box">
                        <label for="name">Nombre:</label>
                        <input type="text" name="name" id="name">
                    </div>
                    <div class="section-box">
                        <label for="task">Tarea:</label>
                        <input type="text" name="task" id="task">
                    </div>

                    <input type="text" style="display:none;" id="uniqid" value="<?php echo uniqid();?>">
                </div>
                <div class="add-button-box">
                    <button type="button" id="add-task">Añadir</button>
                </div>

            </div>
            
        </div>
    </form>

    <form action="">
        <div class="todo-items">
            <?php
            $sql = "SELECT * FROM tasks order by id desc";
            foreach ($pdo->query($sql) as $row) {
                $name = $row['name'];
                $cid= $row['cid'];
                $task = $row['task'];
                echo "
                <div class='td-item'>
                    <div class='top-box'>
                        <h1>$name</h1>
                    </div>
                    <div class='bottom-box'>
                        <div class='task' id='task'>$task</div>
                        <div class='buttons-box'>
                            <button type='button' class='modify' name='$cid'>Modificar</button>
                            <button type='button' id='$cid' class='delete'>Eliminar</button>
                        </div>        
                    </div>
                    <div class='modify-box' id='modify-box' name='cid-box-$cid' style='display:none;'>
                        <label for='new-mdtask-$cid'>Modifica tu tarea:</label>
                        <input value='$task' id='new-mdtask' name='new-mdtask-$cid'>
                        <button type='button' id='apply-modify' class='apply-modify' cid='$cid'>Aplicar</button>
                        <input value='$cid' id='mdtask-id' style='display:none;'>
                    </div>
                </div>
                ";
            }      
            ?>
        </div>
    </form>
    
    <h1 id="respuesta"></h1>
    
</body>

<script>

    //Modify section switch
    let btnsModify = document.querySelectorAll(".modify");
    btnsModify.forEach(btn => {
        btn.addEventListener('click', (event)=> {
            var cid = btn.getAttribute('name');
            modify_box = document.getElementsByName('cid-box-'+cid)[0];
            modify_box.style.display = 'flex';
        })
    })


    //New task section
    $('#add-task').click(function(){
        var name = document.getElementById('name').value;
        var task = document.getElementById('task').value;
        var uniqid = document.getElementById('uniqid').value;
        var route="name="+name+"&task="+task+"&uniqid="+uniqid;
        $.ajax({
            url: 'add.php',
            type: 'POST',
            data: route,
            success: function(){
                location.reload()
            }
        })
    });

    //Modify section
    let btnsModifyApply = document.querySelectorAll(".apply-modify");
    btnsModifyApply.forEach(btn => {
        btn.addEventListener('click', (event)=> {
            cid = btn.getAttribute('cid');
            new_task = document.getElementsByName('new-mdtask-'+cid)[0].value;
            var route="mdtaskTask="+new_task+"&mdtaskId="+cid;
            $.ajax({
                url: 'modify.php',
                type: 'POST',
                data: route,
                success: function(){
                    location.reload()
                }
            })
            
        })
    })


    //Delete section
    let btns = document.querySelectorAll(".delete");
    btns.forEach(btn => {
        btn.addEventListener('click', (event)=> {
            var cid = btn.id;
            $.ajax({
            type: 'POST',
            url: 'delete.php',
            data: "cid="+cid,
            success: function(){
                location.reload()
            }
            })
            
        })
    })


    var countTask = 0;
    function switchTask() {
        if (countTask == 0) {
            document.getElementById("add-taskMenu").style.display = "flex";
            countTask = 1;
        } else {
            document.getElementById("add-taskMenu").style.display = "none";
            countTask = 0;
        }
    }

    

</script>
</html>
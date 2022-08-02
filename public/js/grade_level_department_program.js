function clear_select(input){
    $(input).empty();
    $(input).append($('<option>', {
        value: '',
        text: 'Choose'
    }));

}


function get_set_grade_level(input){

    $.ajax({
        url: window.location.origin+"/populate/grade_level/",
        type: "GET",
        success: function (response) {

            let grade_level = JSON.parse(response); //parse to json
            
            clear_select(input); //clear select

            for (var level of grade_level)  //append result
            {
                console.log(level.id);
                $(input).append($('<option>', {
                    value: level.gl_id,
                    text: level.gl_name
                }));
            }
        },
        error: function(response) {
           console.log(response);
        }
    });
}

function get_set_department(input, dept, grade_level){

    $.ajax({
        url: window.location.origin+"/populate/department/"+grade_level,
        type: "GET",
        success: function (response) {

            let departments = JSON.parse(response); //parse to json
            
            $(input).empty(); //clear select

            console.log(departments);
            for (var department of departments)  //append result
            {
                console.log(department.id);
                $(input).append($('<option>', {
                    value: department.dept_id,
                    text: department.dept_name,
                    selected: (department.dept_id==dept) ? true : false
                }));
            }
        },
        error: function(response) {
           console.log(response);
        }
    });
}
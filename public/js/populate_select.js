function clear_select(input, default_text){
    $(input).empty();
    $(input).append($('<option>', {
        value: '',
        text: default_text
    }));

}

function ucwords(str){
	var result = str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
    	return letter.toUpperCase();
	});
	return result;
}

function get_set_grade_level(input, gl_id){

    $.ajax({
        url: window.location.origin+"/populate/grade_level/",
        type: "GET",
        success: function (response) {

            let grade_level = JSON.parse(response); //parse to json
            console.log(grade_level);
            clear_select(input, '--- Choose Grade level ---'); //clear select

            for (var level of grade_level)  //append result
            {
                $(input).append($('<option>', {
                    value: level.gl_id,
                    text: level.gl_name,
                    selected: (level.gl_id==gl_id) ? true : false
                }));
            }
        },
        error: function(response) {
           console.log(response);
        }
    });
}

function get_set_department(input, dept, grade_level, dept_id){

    $.ajax({
        url: window.location.origin+"/populate/department/"+grade_level,
        type: "GET",
        success: function (response) {

            let departments = JSON.parse(response); //parse to json
            
            clear_select(input, '--- Choose Department ---'); //clear select
            $(input).append($('<option>', {
                value: null,
                text: 'N/A'
            }));

            console.log(departments);
            for (var department of departments)  //append result
            {
                console.log(department.id);
                $(input).append($('<option>', {
                    value: department.dept_id,
                    text: department.dept_name,
                    selected: (department.dept_id==dept_id) ? true : false
                }));
            }
        },
        error: function(response) {
           console.log(response);
        }
    });
}

function get_set_program(input, prog, dept, prog_id){

    $.ajax({
        url: window.location.origin+"/populate/program/"+dept,
        type: "GET",
        success: function (response) {

            let programs = JSON.parse(response); //parse to json
            
            clear_select(input, '--- Choose Program ---'); //clear select
            $(input).append($('<option>', {
                value: null,
                text: 'N/A'
            }));

            console.log(programs);
            for (var program of programs)  //append result
            {
                console.log(program.prog_id);
                $(input).append($('<option>', {
                    value: program.prog_id,
                    text: program.prog_name,
                    selected: (program.prog_id==prog_id) ? true : false
                }));
            }
        },
        error: function(response) {
           console.log(response);
        }
    });
}

function get_set_province(input, prov){

    prov = prov.split("@")[0];
    console.log(prov);

    $.ajax({
        url: window.location.origin+"/populate/province/",
        type: "GET",
        success: function (response) {

            let provinces = JSON.parse(response); //parse to json
            
            console.log(provinces);
            clear_select(input, '--- Choose Province ---'); //clear select

            for (var province of provinces)  //append result
            {
                $(input).append($('<option>', {
                    value: province.provCode+"@"+province.provDesc,
                    text: ucwords(province.provDesc),
                    selected: (province.provCode==prov) ? true : false
                }));
            }
        },
        error: function(response) {
           console.log(response);
        }
    });
}

function get_set_municipality(input, mun, prov){

    prov = prov.split("@")[0];
    console.log(prov);

    $.ajax({
        url: window.location.origin+"/populate/municipality/",
        type: "GET",
        success: function (response) {

            let municipalities = JSON.parse(response); //parse to json
            clear_select(input, '--- Choose Municipality ---'); //clear select

            for (var municipality of municipalities)  //append result
            {
                if(prov==municipality.provCode){
                    $(input).append($('<option>', {
                        value: municipality.citymunCode+"@"+municipality.citymunDesc,
                        text: ucwords(municipality.citymunDesc),
                        selected: (municipality.citymunCode==mun) ? true : false
                    }));
                }
            }
        },
        error: function(response) {
           console.log(response);
        }
    });
}

function get_set_barangay(input, brgy, mun){
    mun = mun.split("@")[0];
    console.log(mun);

    $.ajax({
        url: window.location.origin+"/populate/barangay/",
        type: "GET",
        success: function (response) {

            let barangays = JSON.parse(response); //parse to json
            clear_select(input, '--- Choose Municipality ---'); //clear select

            for (var barangay of barangays)  //append result
            {
                if(mun==barangay.citymunCode){
                    $(input).append($('<option>', {
                        value: barangay.brgyCode+"@"+barangay.brgyDesc,
                        text: ucwords(barangay.brgyDesc),
                        selected: (barangay.brgyCode==brgy) ? true : false
                    }));
                }
            }
        },
        error: function(response) {
           console.log(response);
        }
    });
}
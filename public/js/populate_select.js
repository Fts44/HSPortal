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
            clear_select(input, 'Choose Grade level'); //clear select

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

function get_set_department(input, dept_id, gl_id, prog_input){

    clear_select(input, 'Choose Department'); //clear select
    $(input).append($('<option>', {
        value: 'none',
        text: 'N/A',
        selected: ('none'==dept_id) ? true : false
    }));
    $(prog_input).append($('<option>', {
        value: null,
        text: 'N/A'
    }));
    
    clear_select(prog_input, 'Choose Program');
    $(prog_input).append($('<option>', {
        value: null,
        text: 'N/A'
    }));

    $.ajax({
        url: window.location.origin+"/populate/department/"+gl_id,
        type: "GET",
        success: function (response) {

            let departments = JSON.parse(response); //parse to json

            for (var department of departments)  //append result
            {
                $(input).append($('<option>', {
                    value: department.dept_id,
                    text: department.dept_code,
                    selected: (department.dept_id==dept_id) ? true : false
                }));
            }
        },
        error: function(response) {
           console.log(response);
        }
    });
}

function get_set_program(input, prog_id, dept_id, ){

    clear_select(input, 'Choose Program'); //clear select
    $(input).append($('<option>', {
        value: 'none',
        text: 'N/A',
        selected: ('none'==prog_id) ? true : false
    }));
    
    $.ajax({
        url: window.location.origin+"/populate/program/"+dept_id,
        type: "GET",
        success: function (response) {

            let programs = JSON.parse(response); //parse to json

            for (var program of programs)  //append result
            {
                $(input).append($('<option>', {
                    value: program.prog_id,
                    text: program.prog_code,
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

    clear_select(input, 'Choose Province'); //clear select

    prov = prov.split("@")[0];

    $.ajax({
        url: window.location.origin+"/populate/province/",
        type: "GET",
        success: function (response) {

            let provinces = JSON.parse(response); //parse to json

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

function get_set_municipality(input, mun, prov, brgy_input){

    clear_select(input, 'Choose Municipality'); //clear select
    clear_select(brgy_input, 'Choose Barangay');

    prov = prov.split("@")[0];
    mun = mun.split("@")[0];
    
    $.ajax({
        url: window.location.origin+"/populate/municipality/",
        type: "GET",
        success: function (response) {

            let municipalities = JSON.parse(response); //parse to json

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

    clear_select(input, 'Choose Barangay'); //clear select

    brgy = brgy.split("@")[0];
    mun = mun.split("@")[0];

    $.ajax({
        url: window.location.origin+"/populate/barangay/",
        type: "GET",
        success: function (response) {

            let barangays = JSON.parse(response); //parse to json
            
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
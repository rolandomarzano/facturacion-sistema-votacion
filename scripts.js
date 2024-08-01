$(document).ready(function () {
  $.getJSON('php/departments.php', function (data) {
    $.each(data, function (key, value) {
      $('#department').append(
        $('<option>').text(value.name).attr('value', value.id)
      )
    })

    if (data.length > 0) {
      var firstDepartmentId = data[0].id
      $('#region').val(firstDepartmentId)
      loadDistricts(firstDepartmentId)
    }
  })

  function loadDistricts(departamentId) {
    $('#district')
      .empty()
      .append($('<option>').text('Selecciona un distrito').attr('value', ''))
    if (departamentId) {
      $.getJSON(
        'php/districts.php?department_id=' + departamentId,
        function (data) {
          $.each(data, function (key, value) {
            $('#district').append(
              $('<option>').text(value.name).attr('value', value.id)
            )
          })
        }
      )
    }
  }

  $('#department').change(function () {
    var departamentId = $(this).val()
    loadDistricts(departamentId)
  })

  $.getJSON('php/candidates.php', function (data) {
    $.each(data, function (key, value) {
      $('#candidate').append(
        $('<option>').text(value.name).attr('value', value.id)
      )
    })
  })

  $('#votingForm').submit(function (e) {
    e.preventDefault()
    var errors = []

    if ($('#name').val().trim() === '') {
      errors.push('El nombre es requerido')
    }

    if ($('#last_name').val().trim() === '') {
      errors.push('El apellido es requerido')
    }

    // Validar Alias
    var alias = $('#alias').val().trim()
    if (alias.length <= 5 || !/^(?=.*[a-zA-Z])(?=.*\d).+$/.test(alias)) {
      errors.push(
        'Alias debe tener más de 5 caracteres y contener letras y números'
      )
    }

    if (!/^\d{8}$/.test($('#dni').val().trim())) {
      errors.push('El DNI debe tener 8 dígitos')
    }

    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test($('#email').val().trim())) {
      errors.push('Correo electrónico no válido')
    }

    if ($('#department').val() === '' || $('#district').val() === '') {
      errors.push('Debe seleccionar un Departamento y un Distrito')
    }

    if ($('#candidato').val() === '') {
      errors.push('Debe seleccionar un candidato')
    }

    if ($('input[name="how_know_us[]"]:checked').length < 2) {
      errors.push(
        'Debe seleccionar al menos dos opciones en "Cómo se enteró de Nosotros"'
      )
    }

    if (errors.length > 0) {
      alert(errors.join('\n'))
    } else {
      $.ajax({
        url: 'php/create_vote.php',
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function (response) {
          if (response.success) {
            alert('Voto registrado con éxito')
            $('#votingForm')[0].reset()
          } else {
            alert('Error: ' + response.message)
          }
        },
        error: function () {
          alert('Error al procesar la solicitud')
        },
      })
    }
  })
})

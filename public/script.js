let contentHidden = false;

function showSection(name) {
  
  ['home', 'create', 'read', 'update', 'delete'].forEach(function(id) {
    document.getElementById(id).classList.remove('visible');
  });
  ['btn-create', 'btn-read', 'btn-update', 'btn-delete'].forEach(function(id) {
    document.getElementById(id).classList.remove('active');
  });
  document.getElementById(name).classList.add('visible');
  document.getElementById('btn-' + name).classList.add('active');
}
document.getElementById('logo').addEventListener('click', function () {
  contentHidden = !contentHidden;

  document.querySelectorAll('.content').forEach(function(el) {
    el.style.display = contentHidden ? 'none' : '';
  });
  var active = document.querySelector('section.visible');
  if (contentHidden && active && active.classList.contains('content')) {
    active.classList.remove('visible');
    document.getElementById('home').classList.add('visible');
    ['btn-create', 'btn-read', 'btn-update', 'btn-delete'].forEach(function(id) {
      document.getElementById(id).classList.remove('active');
    });
  }
});


function clearCreate() {
  ['c-surname', 'c-name', 'c-midname', 'c-address', 'c-mobile'].forEach(function(id) {
    document.getElementById(id).value = '';
  });
}

function loadStudentAjax(id) {
  var form = document.getElementById('update-form');

  if (!id) {
    form.style.display = 'none';
    return;
  }

  fetch('../includes/get_student.php?id=' + id)
    .then(function(res) { return res.json(); })
    .then(function(s) {
      if (!s || s.error) {
        form.style.display = 'none';
        return;
      }
      document.getElementById('u-id').value      = s.id;
      document.getElementById('u-surname').value = s.surname;
      document.getElementById('u-name').value    = s.name;
      document.getElementById('u-midname').value = s.midname;
      document.getElementById('u-address').value = s.address;
      document.getElementById('u-mobile').value  = s.mobile;
      form.style.display = 'block';
    })
    .catch(function() {
      form.style.display = 'none';
    });
}

function clearUpdate() {
  ['u-surname', 'u-name', 'u-midname', 'u-address', 'u-mobile'].forEach(function(id) {
    document.getElementById(id).value = '';
  });
}

function loadDeleteInfo(id) {
  var info       = document.getElementById('delete-info');
  var deleteForm = document.getElementById('delete-form');

  if (!id) {
    info.style.display = 'none';
    deleteForm.style.display = 'none';
    return;
  }

  fetch('../includes/get_student.php?id=' + id)
    .then(function(res) { return res.json(); })
    .then(function(s) {
      if (!s || s.error) {
        info.style.display = 'none';
        deleteForm.style.display = 'none';
        return;
      }
      document.getElementById('d-id').value = s.id;
      info.innerHTML =
        '<p><strong>ID:</strong> ' + s.id + '</p>' +
        '<p><strong>Name:</strong> ' + esc(s.surname) + ', ' + esc(s.name) + ' ' + esc(s.midname) + '</p>' +
        '<p><strong>Address:</strong> ' + esc(s.address) + '</p>' +
        '<p><strong>Mobile:</strong> ' + esc(s.mobile) + '</p>' +
        '<p style="margin-top:10px;color:#c00;">Are you sure you want to delete this record?</p>';
      info.style.display = 'block';
      deleteForm.style.display = 'block';
    })
    .catch(function() {
      info.style.display = 'none';
      deleteForm.style.display = 'none';
    });
}

function cancelDelete() {
  document.getElementById('d-select').value        = '';
  document.getElementById('delete-info').style.display  = 'none';
  document.getElementById('delete-form').style.display  = 'none';
}

function esc(str) {
  return String(str || '')
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;');
}

(function () {
  var params  = new URLSearchParams(window.location.search);
  var section = params.get('section');
  if (section && ['create','read','update','delete'].includes(section)) {
    showSection(section);
  }
})();
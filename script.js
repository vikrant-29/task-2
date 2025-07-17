document.getElementById('contactForm').addEventListener('submit', function(e) {
  e.preventDefault();
  
  const name = document.getElementById('name').value;
  const email = document.getElementById('email').value;
  const message = document.getElementById('message').value;
  
  // Reset previous error states
  document.querySelectorAll('.error').forEach(el => el.remove());
  
  let isValid = true;
  
  // Name validation
  if (name.trim() === '') {
    showError('name', 'Name is required');
    isValid = false;
  }
  
  // Email validation
  if (email.trim() === '') {
    showError('email', 'Email is required');
    isValid = false;
  } else if (!isValidEmail(email)) {
    showError('email', 'Please enter a valid email');
    isValid = false;
  }
  
  // Message validation
  if (message.trim() === '') {
    showError('message', 'Message is required');
    isValid = false;
  }
  
  if (isValid) {
    alert('Form submitted successfully!');
    this.reset();
  }
});

function showError(fieldId, message) {
  const field = document.getElementById(fieldId);
  const errorElement = document.createElement('div');
  errorElement.className = 'error';
  errorElement.style.color = 'red';
  errorElement.style.fontSize = '0.8em';
  errorElement.style.marginTop = '5px';
  errorElement.textContent = message;
  field.parentNode.appendChild(errorElement);
  field.style.borderColor = 'red';
}

function isValidEmail(email) {
  const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return re.test(email);
}

// JavaScript
document.getElementById('addBtn').addEventListener('click', addTodo);
document.getElementById('todoInput').addEventListener('keypress', function(e) {
  if (e.key === 'Enter') addTodo();
});

function addTodo() {
  const input = document.getElementById('todoInput');
  const todoText = input.value.trim();
  
  if (todoText === '') {
    alert('Please enter a task');
    return;
  }
  
  const li = document.createElement('li');
  
  const taskSpan = document.createElement('span');
  taskSpan.textContent = todoText;
  
  const deleteBtn = document.createElement('button');
  deleteBtn.textContent = 'Delete';
  deleteBtn.className = 'deleteBtn';
  deleteBtn.addEventListener('click', function() {
    li.remove();
  });
  
  li.appendChild(taskSpan);
  li.appendChild(deleteBtn);
  
  li.addEventListener('click', function() {
    li.classList.toggle('completed');
  });
  
  document.getElementById('todoList').appendChild(li);
  input.value = '';
}
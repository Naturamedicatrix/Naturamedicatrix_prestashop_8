/**
 * Password toggle functionality
 * Allows users to show/hide password field content
 */
document.addEventListener('DOMContentLoaded', function() {
  // Sélectionner tous les boutons de basculement de mot de passe
  const toggleButtons = document.querySelectorAll('.password-toggle-btn');
  
  // Ajouter un gestionnaire d'événements à chaque bouton
  toggleButtons.forEach(function(button) {
    button.addEventListener('click', function() {
      // Trouver l'input associé au bouton
      const targetId = this.getAttribute('data-target');
      const passwordInput = document.getElementById(targetId);
      const icon = this.querySelector('.password-toggle-icon');
      const text = this.querySelector('.password-toggle-text');
      
      // Basculer le type de l'input entre 'password' et 'text'
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
        text.textContent = 'Masquer';
      } else {
        passwordInput.type = 'password';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
        text.textContent = 'Afficher';
      }
    });
  });
});

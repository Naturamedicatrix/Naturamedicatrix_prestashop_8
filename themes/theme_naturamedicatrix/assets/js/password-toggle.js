/**
 * Fonction pour permettre d'afficher ou masquer le champ d'un password
 * Change l'icone et le texte selon l'état
 */
document.addEventListener('DOMContentLoaded', function() {
  // sélectionne les btn password
  const toggleButtons = document.querySelectorAll('.password-toggle-btn');
  
  // Ajoute la gestion d'event sur chaque btn password
  toggleButtons.forEach(function(button) {
    button.addEventListener('click', function() {
      // Sélectionne l'input associé au bouton
      const targetId = this.getAttribute('data-target');
      const passwordInput = document.getElementById(targetId);
      const icon = this.querySelector('.password-toggle-icon');
      const text = this.querySelector('.password-toggle-text');
      
      // Bascule le type de l'input entre 'password' et 'text'
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

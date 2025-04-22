# Classic Tailwind Theme

Un thème enfant PrestaShop basé sur le thème Classic avec l'intégration de Tailwind CSS.

## Caractéristiques

- Hérite de toutes les fonctionnalités du thème Classic
- Intègre Tailwind CSS avec un préfixe `tw-` pour éviter les conflits avec Bootstrap
- Permet de personnaliser facilement l'apparence de votre boutique avec les classes utilitaires de Tailwind

## Installation

1. Copiez le dossier `classic_tailwind` dans le répertoire `themes/` de votre installation PrestaShop
2. Accédez au back-office de PrestaShop
3. Allez dans Design > Thème & Logo
4. Activez le thème "Classic with Tailwind"

## Développement

### Prérequis

- Node.js et npm installés

### Installation des dépendances

```bash
cd themes/classic_tailwind
npm install
```

### Compilation des styles Tailwind

```bash
# Compilation unique
npm run build:css

# Compilation en mode watch (pour le développement)
npm run watch:css
```

## Personnalisation

### Utilisation des classes Tailwind

Toutes les classes Tailwind sont préfixées avec `tw-` pour éviter les conflits avec Bootstrap. Par exemple :

```html
<div class="tw-bg-blue-500 tw-text-white tw-p-4 tw-rounded">
  Contenu avec des styles Tailwind
</div>
```

### Création de composants personnalisés

Vous pouvez créer vos propres composants dans le fichier `assets/css/tailwind-source.css` :

```css
@layer components {
  .tw-btn-custom {
    @apply tw-bg-blue-500 tw-text-white tw-py-2 tw-px-4 tw-rounded tw-shadow hover:tw-bg-blue-600;
  }
}
```

### Surcharge des templates

Pour personnaliser un template du thème parent, créez simplement un fichier avec le même chemin relatif dans votre thème enfant. Par exemple :

- Thème parent : `themes/classic/templates/_partials/footer.tpl`
- Thème enfant : `themes/classic_tailwind/templates/_partials/footer.tpl`

## Structure du thème

```
classic_tailwind/
├── _dev/                  # Fichiers de développement
├── assets/
│   ├── css/
│   │   ├── tailwind.css   # CSS compilé (généré)
│   │   └── tailwind-source.css  # Source Tailwind
│   ├── js/
│   └── img/
├── config/
│   └── theme.yml         # Configuration du thème
├── templates/            # Templates surchargés
│   └── _partials/
│       └── footer.tpl    # Footer personnalisé
├── package.json          # Dépendances npm
├── postcss.config.js     # Configuration PostCSS
├── tailwind.config.js    # Configuration Tailwind
└── preview.jpg           # Aperçu du thème
```

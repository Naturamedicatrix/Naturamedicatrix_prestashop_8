<style>
      /* Menu sticky */
      #sticky-product-bar {
        display: none; /* Menu caché par défaut */
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        background-color: #fff;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        z-index: 99;
        padding: 15px 0;
        transition: transform 0.3s ease;
      }
      
      #sticky-product-bar .sticky-container {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 25px;
      }
      
      #sticky-product-bar .sticky-product-name {
        font-weight: bold;
        font-size: 1rem;
      }
      
      #sticky-product-bar .sticky-actions {
        display: flex;
      }
      
      #sticky-product-bar .btn-quantity {
        width: 40px;
        height: 40px;
        background-color: #f5f5f5;
        border: 1px solid #ddd;
        cursor: pointer;
        font-size: 16px;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      
      #sticky-product-bar .sticky-qty {
        width: 30px;
        height: 40px;
        text-align: center;
        border: 1px solid #ddd;
        font-size: .8rem;
        padding: 0;
        margin: 0;
      }
      
      #sticky-product-bar .quantity-group {
        display: flex;
        align-items: center;
      }
      
      #sticky-product-bar .add-to-cart {
        height: 40px;
        font-size: .8rem;
        align-items: center;
        justify-content: center;
      }
</style>


<!-- Menu sticky qui apparaît lors du défilement -->
<div id="sticky-product-bar">
    <div class="sticky-container">
        {if $product.availability == 'available'}
        <div class="sticky-product-name">{$productName nofilter}</div>
        <div class="quantity-group">
            <button class="btn-quantity" onclick="decrementQuantity(event)">−</button>
            <input
            type="number"
            name="sticky-qty"
            class="sticky-qty"
            value="1"
            min="1"
            />
            <button class="btn-quantity" onclick="incrementQuantity(event)">+</button>
        </div>
        <button class="btn btn-primary add-to-cart" data-button-action="add-to-cart" type="submit" {if !$product.add_to_cart_url}disabled{/if}>
            <i class="bi bi-handbag"></i> {l s='Add to cart' d='Shop.Theme.Actions'} &#x2012; {$product.price}
        </button>
        {/if}
    </div>
</div>




<script>
// Fonctions pour le menu sticky (incrément/décrément quantité)
function incrementQuantity(event) {
  event.preventDefault();
  const qtyInput = document.querySelector('.sticky-qty');
  const originalQtyInput = document.querySelector('input[name="qty"]');
  let value = parseInt(qtyInput.value, 10);
  value = isNaN(value) ? 1 : value + 1;
  qtyInput.value = value;
  if (originalQtyInput) { originalQtyInput.value = value; }
}

function decrementQuantity(event) {
  event.preventDefault();
  const qtyInput = document.querySelector('.sticky-qty');
  const originalQtyInput = document.querySelector('input[name="qty"]');
  let value = parseInt(qtyInput.value, 10);
  value = isNaN(value) || value <= 1 ? 1 : value - 1;
  qtyInput.value = value;
  if (originalQtyInput) { originalQtyInput.value = value; }
}

// Gestion du menu sticky
document.addEventListener('DOMContentLoaded', function() {
  var stickyBar = document.getElementById('sticky-product-bar');
  var productAddToCart = document.querySelector('.product-add-to-cart');
  
  if (!stickyBar || !productAddToCart) return;
  
  // Configuration visuelle initiale
  stickyBar.style.opacity = '0';
  stickyBar.style.transform = 'translateY(20px)';
  stickyBar.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
  stickyBar.style.display = 'none';
  
  // Synchronisation quantité sticky -> original
  var stickyQty = document.querySelector('.sticky-qty');
  if (stickyQty) {
    stickyQty.addEventListener('input', function() {
      var originalQty = document.querySelector('input[name="qty"]');
      if (originalQty) { originalQty.value = this.value; }
    });
  }
  
  // Synchronisation du bouton d'ajout au panier
  var stickyAddBtn = stickyBar.querySelector('.add-to-cart');
  if (stickyAddBtn) {
    stickyAddBtn.addEventListener('click', function(e) {
      e.preventDefault();
      
      // Synchroniser la quantité
      var originalQty = document.querySelector('input[name="qty"]');
      var stickyQty = document.querySelector('.sticky-qty');
      if (originalQty && stickyQty) {
        originalQty.value = stickyQty.value;
      }
      
      // Cliquer sur le bouton principal
      var mainAddBtn = document.querySelector('#add-to-cart-or-refresh .add-to-cart');
      if (mainAddBtn) { mainAddBtn.click(); }
    });
  }
  
  // Fonctions d'affichage/masquage
  function showStickyBar() {
    stickyBar.style.display = 'block';
    setTimeout(function() {
      stickyBar.style.opacity = '1';
      stickyBar.style.transform = 'translateY(0)';
    }, 10);
  }
  
  function hideStickyBar() {
    stickyBar.style.opacity = '0';
    stickyBar.style.transform = 'translateY(20px)';
    setTimeout(function() {
      stickyBar.style.display = 'none';
    }, 400);
  }
  
  // Configuration de l'Intersection Observer
  var observer = new IntersectionObserver(function(entries) {
    entries.forEach(function(entry) {
      if (!entry.isIntersecting) {
        showStickyBar();
      } else {
        hideStickyBar();
      }
    });
  }, { threshold: 0.1 });
  
  // Observer le bouton d'ajout au panier
  observer.observe(productAddToCart);
});
</script>
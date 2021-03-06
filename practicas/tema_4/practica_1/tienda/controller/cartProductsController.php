<?php
session_start();
include('../model/products.php');

if (!isset($_SESSION['cartProducts'])) {
  $_SESSION['cartProducts'] = array();
}

if (isset($_POST['cartAction'])) {
  $res = 'error';
  switch ($_POST['cartAction']) {
    case 'addCartProduct':
      addCartProduct($_POST['id'], readProducts('../model/store.txt'));
      $res = 'ok';
      break;
    case 'getCartProducts':
      if (count($_SESSION['cartProducts']) > 0) {
        $res = getCartProducts();
      } else {
        $res = '<p class="content is-medium has-font-weight-bold has-text-grey-light">There are no products in your cart</p>';
      }
      break;
    case 'deleteCartProduct':
      deleteCartProduct($_POST['id']);
      $res = 'ok';
      break;
    case 'getCartNumItems':
      $res = getCartNumItems();
      break;
    case 'changeQuantityCartProduct':
      changeQuantityCartProduct($_POST['id'], $_POST['quantity']);
      $res = 'ok';
      break;
    case 'getTotalPrice':
      $res = getTotalPrice();
      break;
  }

  echo $res;
}

function addCartProduct($id, $products)
{
  $product = $products[array_search($id, array_column($products, 'id'))];

  $productInCartKey = array_search($id, array_column($_SESSION['cartProducts'], 'id'));
  // 2 hours of debugging to realize that 0 == false = true :/
  if ($productInCartKey !== false) {
    $_SESSION['cartProducts'][$productInCartKey]['quantity'] += 1;
  } else {
    $product['quantity'] = 1;

    $_SESSION['cartProducts'][] = $product;
  }
}

function deleteCartProduct($id)
{
  $productInCartKey = array_search($id, array_column($_SESSION['cartProducts'], 'id'));
  echo $productInCartKey;

  if ($productInCartKey !== false) {
    unset($_SESSION['cartProducts'][$productInCartKey]);
    $_SESSION['cartProducts'] = array_values($_SESSION['cartProducts']);
  }
}


function changeQuantityCartProduct($id, $quantity)
{
  $productInCartKey = array_search($id, array_column($_SESSION['cartProducts'], 'id'));

  if ($productInCartKey !== false) {
    if (is_numeric($quantity)) {
      $_SESSION['cartProducts'][$productInCartKey]['quantity'] = $quantity;
    } else {
      $_SESSION['cartProducts'][$productInCartKey]['quantity'] = 0;
    }
  }
}

function getCartProducts()
{
  $output = '';
  foreach ($_SESSION['cartProducts'] as $cartProduct) {
    $cartProductHTML = '
      <div class="cartProduct mb-6">
        <div class="box level">
          <div class="level-left">
            <div class="level-item">
              <figure class="is-128x128 image" style="margin: 1rem auto">
                <img src="productImages/' . $cartProduct['imgUrl'] . '" alt="Placeholder image" style="width:100%;height:100%;object-fit:cover">
              </figure>
            </div>
            <div class="level-item">
              <div class="">
                <p class="title is-4">' . $cartProduct['title'] . '</p>
                <p>' . $cartProduct['desc'] . '</p>
                <p class="mt-4 has-text-primary is-size-5">' . $cartProduct['price'] . '€</p>
              </div>
            </div>
          </div>
          <div class="level-right">
            <div class="level-item mr-4">
              <button data-id="' . $cartProduct['id'] . '" class="delete-cart-product button">
                <span class="icon has-text-danger">
                  <i class="fas fa-trash"></i>
                </span>
              </button>
            </div>
            <div class="level-item"> 
              <div class="field has-addons">
                <div class="control">
                  <button id="add-quantity" class="button is-static">
                  Quantity 
                  </button>
                </div>
                <div class="control">
                  <input data-id="' . $cartProduct['id'] . '" value="' . $cartProduct['quantity'] . '" class="quantity-cart-product input" type="number" min=0 max=100 style="width:4.2rem;">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>';

    $output .= $cartProductHTML;
  }
  $output .= '
   
  ';

  return $output;
}

function getCartNumItems()
{
  $count = 0;
  foreach ($_SESSION['cartProducts'] as $product) {
    $count += $product['quantity'];
  }
  return $count;
}

function getTotalPrice()
{
  $total = 0;
  foreach ($_SESSION['cartProducts'] as $product) {
    $total += $product['price'] * $product['quantity'];
  }
  return $total;
}

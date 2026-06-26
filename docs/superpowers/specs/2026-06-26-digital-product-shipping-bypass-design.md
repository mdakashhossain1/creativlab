# Spec: Digital Product Shipping Bypass & Paypal Delivery Fix

This specification outlines the technical design for skipping shipping requirements during checkout when the user's cart contains exclusively digital products, and ensuring digital delivery is correctly dispatched when paying via PayPal or when the order status is modified by the admin.

## Proposed Changes

### Checkout Flow Modifications

#### [CheckoutController.php](file:///c:/xampp_8.2/htdocs/creativlab/landing-new/Modules/Ecommerce/Http/Controllers/CheckoutController.php)
- Calculate if the cart is exclusively digital:
  ```php
  $isOnlyDigital = $carts->isNotEmpty() && $carts->every(fn($cart) => $cart->product?->is_digital);
  ```
- Pass `$isOnlyDigital` to the `checkout` blade view.
- In `processToPayment(Request $request)`:
  - Calculate `$isOnlyDigital` based on the cart.
  - Dynamically define validation rules:
    ```php
    $rules = [
        'name' => 'required',
        'email' => 'required',
        'phone' => 'required',
    ];
    if (!$isOnlyDigital) {
        $rules['shipping_method_id'] = 'required';
        $rules['address'] = 'required';
    } else {
        $rules['shipping_method_id'] = 'nullable';
        $rules['address'] = 'nullable';
    }
    ```
  - Sanitize the input for order details:
    ```php
    $shipping_method_id = !$isOnlyDigital ? $request->shipping_method_id : 0;
    $shipping_charge = !$isOnlyDigital ? $request->shipping_charge : 0;
    $address = !$isOnlyDigital ? $request->address : ($request->address ?? 'Digital Delivery');
    ```
  - Save to the order details session.
  - Pass `$isOnlyDigital` to the `payment` blade view.

#### [checkout.blade.php](file:///c:/xampp_8.2/htdocs/creativlab/landing-new/Modules/Ecommerce/Resources/views/frontend/checkout.blade.php)
- Hide the Shipping Method box visually and input a hidden tag for shipping method ID:
  ```blade
  @if(!$isOnlyDigital)
      <!-- Existing Shipping Method Select Box HTML -->
  @else
      <input type="hidden" name="shipping_method_id" value="0">
  @endif
  ```
- Hide the "Delivery Fee" row using Tailwind's `hidden` class if `$isOnlyDigital`.
- Adjust the address label to show "Full Address (Optional)" if `$isOnlyDigital`.
- Update the javascript function `parseCurrency` to handle empty strings / NaN cases cleanly:
  ```javascript
  function parseCurrency(currencyStr) {
      if (!currencyStr) return 0;
      const parsed = parseFloat(currencyStr.replace(/[^0-9.-]+/g, ''));
      return isNaN(parsed) ? 0 : parsed;
  }
  ```

#### [payment.blade.php](file:///c:/xampp_8.2/htdocs/creativlab/landing-new/Modules/Ecommerce/Resources/views/frontend/payment.blade.php)
- Hide the "Delivery Fee" row if `$isOnlyDigital` is true:
  ```blade
  @if(!$isOnlyDigital)
      <!-- Delivery Fee row HTML -->
  @endif
  ```

### Digital Delivery Dispatches

#### [UserPaypalController.php](file:///c:/xampp_8.2/htdocs/creativlab/landing-new/Modules/Ecommerce/Http/Controllers/UserPaypalController.php)
- Implement `dispatchDigitalDelivery` and `buildDownloadLinksHtml` methods to generate download tokens and send digital delivery emails when orders are completed successfully via PayPal.
- In `create_order`, call the new `dispatchDigitalDelivery` helper when `$payment_status` is `Status::APPROVED`:
  ```php
  if ($payment_status === Status::APPROVED) {
      $this->dispatchDigitalDelivery($order, $user);
  }
  ```

#### [OrderController.php (Admin)](file:///c:/xampp_8.2/htdocs/creativlab/landing-new/Modules/Ecommerce/Http/Controllers/Admin/OrderController.php)
- In the `updateStatus` method, track if the payment transitioned to approved:
  ```php
  $wasApproved = $order->payment_status == Status::APPROVED;
  // ... save update status changes ...
  if (!$wasApproved && $order->payment_status == Status::APPROVED) {
      $this->dispatchDigitalDelivery($order);
  }
  ```

## Verification Plan

### Manual Verification
- Add a digital product to the cart and verify that the shipping method drop-down and delivery fee line items are hidden during checkout.
- Complete a checkout for a digital product via PayPal and Stripe (in sandbox/mock mode) and verify that the order contains download tokens, and is visible on the user account's `/user/downloads` page.
- Test admin manual approval of a pending bank transfer order for a digital product and verify that the email is dispatched and order downloads become active.

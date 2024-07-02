# WHMCS Module: Order API Integration

## Overview

This WHMCS module integrates with external APIs to perform actions upon order events such as checkout completion, order acceptance, or order cancellation.

### Features

- Hooks into WHMCS order events.
- Makes API calls to external services.
- Logs activities for debugging.

## Installation

1. **Upload Module Files:**
   - Upload the `orderapicall` module folder to your WHMCS `modules/addons/` directory.

2. **Activate Module:**
   - Log in to WHMCS admin dashboard.
   - Navigate to **Setup > Addon Modules**.
   - Find "Order API Call" module and click **Activate**.

## Configuration

1. **Set API Endpoint:**
   - Add API URL in Configure Option.
   - And Save.

## Usage

### Available Hooks

#### ShoppingCartCheckoutComplete

- Triggered after a successful checkout.
- Sends order details to the configured API endpoint.

#### AcceptOrder

- Triggered when an order is manually accepted.
- Sends order acceptance details to the configured API endpoint.

#### CancelOrder

- Triggered when an order is canceled.
- Sends order cancellation details to the configured API endpoint.


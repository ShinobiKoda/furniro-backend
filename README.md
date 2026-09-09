```markdown

# Furniro — Furniture E‑commerce UI

Interactive, responsive furniture storefront featuring product browsing, rich product details, cart, wishlist, checkout, blog, and contact pages. Powered by Next.js App Router, Tailwind CSS, Framer Motion, and a RESTful Laravel API.

</div>

## ✨ Features

- **Modern Interface:** Landing page with animated hero, category highlights, and product carousels.
- **SEO-Optimized Product Details:** Clean URL routing using product slugs (e.g., `/furniture/modern-sofa`) with specs, warranty tabs, reviews, and related items.
- **Optimized Data Fetching:** Utilizes Next.js Incremental Static Regeneration (ISR) to cache API responses and ensure lightning-fast page loads.
- **Persistent State:** Cart and Wishlist states are maintained via Context and `localStorage` with animated slide-in modals.
- **Blog & Information Pages:** Blog page with pagination, along with interactive Contact and About pages.
- **Global Navbar:** Includes search functionality, wishlist, and cart counters in a fully responsive layout.
- **Image Optimization:** Utilizes `next/image` with remote patterns configured for external assets and backend storage.

## 🛠️ Tech Stack

- **Framework:** Next.js 15 (App Router), React 19
- **Styling:** Tailwind CSS v4 (`@tailwindcss/postcss`)
- **Animations:** Framer Motion
- **State Management:** React Context (Cart, Liked Items) + `localStorage`
- **Data Fetching:** Native `fetch` API with Next.js ISR capabilities
- **Icons:** `lucide-react`, `react-icons`
- **Backend:** Laravel REST API (Hosted on Render)

## 📦 Getting Started

### Requirements
- Node.js 18+ (recommended 18.18 or 20+)

### Installation

1. Clone the repository and install dependencies:
   ```bash
   npm install

```

2. Create an environment file:
```bash
cp .env.example .env.local

```


3. Update `.env.local` with the live production backend URL:
```env
# The base URL for the Furniro Laravel backend API
NEXT_PUBLIC_API_URL=[https://furniro-backend-ausv.onrender.com/api](https://furniro-backend-ausv.onrender.com/api)

```


4. Run the development server:
```bash
npm run dev

```


5. Open [http://localhost:3000](http://localhost:3000) in your browser.

> **Important Note on Images:** Because product images are served from the backend or external domains, ensure your `next.config.ts` includes `furniro-backend-ausv.onrender.com` (and any other asset domains like Unsplash or Pixabay) in the `remotePatterns` array.

## 🗄️ Data Model (API Responses)

The application fetches data from the REST API adhering to these primary TypeScript interfaces:

* **`Product`**
* `id` (number)
* `name` (string)
* `slug` (string) — Used for URL routing
* `sku` (string)
* `price` (number)
* `compare_at_price` (number | null)
* `stock` (number)
* `is_active` (boolean)
* `image_url` (string | null)
* `description` / `short_description` (string)
* `specifications` (Record / JSON)
* `category` (Relationship)
* `review` (Relationship)



The app fetches data via:

* `src/services/products.ts` — `fetchProducts()` (catalog query) and `fetchProductBySlug(slug)` (single item query)
* `src/services/categories.ts` — Category lookups

## 📁 Project Structure (Selected)

```text
src/
  app/
    page.tsx                   # Redirects / -> /home
    home/page.tsx              # Home
    shop/page.tsx              # Catalog
    furniture/[slug]/page.tsx  # Product details (Slug-based routing)
    cart/page.tsx              # Cart
    checkout/page.tsx          # Checkout
    blog/page.tsx              # Blog
    layout.tsx                 # Providers + Navbar + global styles
  components/
    FurnitureCard.tsx          # Product card
    FurnitureDetails.tsx       # Product details view
    Cart.tsx / CartModal.tsx   # Cart page + slide-in
    WishlistModal.tsx          # Wishlist slide-in
    layout/navbar.tsx          # Navbar with search/cart/wishlist
  context/
    CartContext.tsx            # Cart state (localStorage)
    LikedItemsContext.tsx      # Wishlist state (stores product slugs)
  services/
    products.ts                # API fetching logic for products (ISR enabled)
    categories.ts              # API fetching logic for categories
  types/
    type.ts                    # Global TypeScript interfaces
  lib/
    config.ts                  # ENV configuration exports
public/
  images/                      # Local fallback images
  data/blogs.json              # Blog seed data

```

## 🧠 Development Notes

* **State Management:** The cart and wishlist persist in the browser via `localStorage` keys (`furniro-cart-items`, `furniro-liked-items`).
* **Wishlist Hydration:** The `LikedItemsContext` stores an array of product **slugs**. When the `WishlistModal` is opened, it dynamically fetches the latest product data for those slugs directly from the Render backend to ensure pricing and stock are accurate.
* **Caching & ISR:** The application uses Next.js fetch caching (`next: { revalidate: 60 }`). Database updates made in the backend will reflect on the frontend catalog after the 60-second cache window expires.

## 📄 Available Scripts

* `npm run dev` — Starts the development server using Turbopack
* `npm run build` — Creates an optimized production build
* `npm start` — Starts the production server
* `npm run lint` — Lints the codebase with ESLint

## 🤝 Contributing

Issues and pull requests are welcome. Please ensure you run `npm run lint` before opening a pull request.
# ClueNest Product Architecture
**Version:** 1.0
**Status:** Draft
**Author:** Adil Baig & ChatGPT
**Last Updated:** July 2026

---

# 1. Vision

## Mission

Help people make better buying decisions while building a scalable affiliate business.

ClueNest is not a blogging platform.

ClueNest is a **Product Intelligence Platform** where products are the source of truth and all content is generated around those products.

---

# 2. Core Philosophy

## Build Once. Publish Everywhere.

A product should only be created once.

Everything else should reuse that product.

Example

One Product

↓

LG 7 Kg Front Load Washing Machine

↓

Can automatically appear in

- Product Review
- Buying Guide
- Product Comparison
- Brand Page
- Category Page
- Homepage Sections
- Search Results

No duplicate information.

---

# 3. Primary Goal

Generate affiliate revenue by helping users choose the right products.

Affiliate links are the monetization method.

Helping users is the product.

---

# 4. Product Lifecycle

Admin

↓

Create Product

↓

Add Specifications

↓

Add Images

↓

Add Affiliate Links

↓

Publish Product

↓

Reuse Everywhere

---

# 5. Core Objects

Everything in ClueNest revolves around these objects.

1. Brand
2. Category
3. Product
4. Buying Guide
5. Comparison
6. SEO

Nothing should exist independently from these unless absolutely necessary.

---

# 6. Brand

Example

LG

Samsung

Bosch

Stores

- Name
- Logo
- Description
- Website
- SEO Information

Relationship

One Brand

↓

Many Products

---

# 7. Category

Example

Home Appliances

↓

Washing Machines

↓

Front Load

Stores

- Name
- Parent Category
- Description
- SEO

Relationship

One Category

↓

Many Products

---

# 8. Product (Heart of ClueNest)

The Product is the most important object.

Every product exists only once.

Stores

- Product Name
- Brand
- Category
- Images
- Price
- Specifications
- Pros
- Cons
- Rating
- Affiliate Links
- Status
- Last Updated

Everything else references the Product.

---

# 9. Buying Guide

Example

Best Washing Machines Under ₹15,000

Stores

- Title
- Introduction
- Selected Products
- Hero Product
- FAQs
- SEO

A Buying Guide never duplicates product information.

It only references products.

---

# 10. Comparison

Example

LG vs Samsung

Stores

- Product A
- Product B
- Summary
- Winner
- SEO

Specifications come directly from Products.

---

# 11. Affiliate Links

Each product can contain multiple affiliate links.

Examples

- Amazon
- Flipkart
- Croma
- Official Website

Future affiliate networks can be added without changing the product structure.

---

# 12. SEO

Every published page should automatically support

- SEO Title
- Meta Description
- Canonical URL
- Open Graph
- Breadcrumbs
- FAQ Schema
- Product Schema

SEO should be generated from product data wherever possible.

---

# 13. Content Strategy

ClueNest is data-driven.

We manage products.

We do not manually duplicate product information into articles.

Examples of content

- Product Review
- Buying Guide
- Comparison
- Brand Page
- Category Page

All of these reuse existing product data.

---

# 14. Product Entry Workflow

Goal

A new product should take less than 10 minutes to create.

Workflow

Create Product

↓

Upload Images

↓

Fill Specifications

↓

Paste Affiliate Links

↓

Add Pros & Cons

↓

Publish

---

# 15. Buying Guide Workflow

Create Buying Guide

↓

Enter Title

↓

Choose Products

↓

Select Hero Product

↓

Write Introduction

↓

Publish

The rest is generated automatically.

---

# 16. Comparison Workflow

Choose Product A

↓

Choose Product B

↓

Publish

The comparison table is generated automatically.

---

# 17. Design Principles

✔ Build Once

✔ Reuse Everywhere

✔ Never Duplicate Data

✔ Easy to Maintain

✔ SEO Friendly

✔ Fast Publishing

✔ Scalable

---

# 18. Future Roadmap

Phase 1

Affiliate Website

- Products
- Buying Guides
- Comparisons
- SEO

Phase 2

Content Automation

- Bulk Product Import
- AI Assistance
- Price Updates

Phase 3

SaaS

- Multi-site
- User Accounts
- API
- Licensing

---

# 19. Success Metrics

Business

- Affiliate Revenue
- Organic Traffic
- Click Through Rate
- Conversion Rate

Technical

- Single Source of Truth
- Fast Product Creation
- Minimal Duplicate Content
- Modular Architecture

---

# 20. Golden Rule

Everything starts with a Product.

Products create content.

Content attracts visitors.

Visitors click affiliate links.

Affiliate links generate revenue.

Never build a feature that duplicates product information.

Build once.

Publish everywhere.
# ClueNest Database Design
**Version:** 1.0
**Status:** Draft
**Last Updated:** July 2026

---

# Purpose

This document defines the data model for ClueNest.

It is NOT a SQL document.

It describes what data exists and how everything is connected.

---

# Core Principle

Every entity has a Single Source of Truth.

No duplicate product information should exist.

Everything references the Product Profile.

---

# Entity Relationship

Brand
│
├── Products
│
Category
│
├── Products
│
Product Profile
│
├── Images
├── Specifications
├── Affiliate Links
├── SEO
│
├─────────────┐
│             │
Buying Guide  Comparison
│             │
└─────────────┘

---

# Brand

Purpose

Stores manufacturer information.

Fields

- ID
- Name
- Slug
- Logo
- Website
- Description
- Status

Relationship

One Brand

↓

Many Product Profiles

---

# Category

Purpose

Groups products.

Supports parent and child categories.

Fields

- ID
- Parent ID
- Name
- Slug
- Description
- Status

Relationship

One Category

↓

Many Product Profiles

---

# Product Profile ⭐

Purpose

Single Source of Truth.

Every product exists only once.

Fields

- ID
- Product Name
- Slug
- Brand
- Category
- Short Description
- Long Description
- Editorial Rating
- Status
- Created Date
- Updated Date

Relationship

One Product Profile

↓

Many Images

↓

Many Specifications

↓

Many Affiliate Links

↓

One SEO Record

↓

Many Buying Guides

↓

Many Comparisons

---

# Product Images

Purpose

Stores all product images.

Fields

- ID
- Product ID
- Image URL
- Alt Text
- Display Order
- Primary Image

---

# Specifications

Purpose

Flexible specification storage.

Fields

- Product ID
- Specification Name
- Specification Value

Examples

Capacity

↓

7 Kg

Motor

↓

Inverter

Screen Size

↓

55 Inch

No database changes are required when adding new specification types.

---

# Affiliate Links

Purpose

Stores links for different affiliate partners.

Fields

- Product ID
- Partner
- Affiliate URL
- Status

Example Partners

Amazon

Flipkart

Croma

Official Website

---

# Buying Guide

Purpose

Collection of Product Profiles.

Fields

- ID
- Title
- Slug
- Introduction
- Conclusion
- SEO

Buying Guides never duplicate Product information.

---

# Buying Guide Products

Purpose

Connect Products to Buying Guides.

Fields

- Buying Guide ID
- Product ID
- Position
- Hero Product

One Product Profile can belong to unlimited Buying Guides.

---

# Comparison

Purpose

Compare two or more Product Profiles.

Fields

- ID
- Title
- Slug
- Summary
- Winner
- SEO

Specifications always come from Product Profiles.

---

# SEO

Purpose

Stores SEO information.

Fields

- Entity Type
- Entity ID
- Meta Title
- Meta Description
- Canonical URL
- Schema

Supported Entities

- Product Profile
- Brand
- Category
- Buying Guide
- Comparison

---

# Future Modules

- Price History
- Product Videos
- AI Suggestions
- Product Tags
- User Reviews
- API

These are outside Version 1.

---

# Golden Rule

Update once.

Reflect everywhere.

Every module references Product Profiles.

Nothing duplicates Product information.
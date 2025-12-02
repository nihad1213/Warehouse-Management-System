# Warehouse Management System (WMS) - Complete Guide

## 1. Core Purpose of a WMS

A WMS system controls:
- How products enter the warehouse
- How products are stored
- How products move within the facility
- How products leave the warehouse
- Who performs actions inside the warehouse

**Core Requirements:** Users, roles, permissions, products, inventory, locations, transactions, and operations.

---

## 2. User Management
### User Types
- **Admin** - Full system control
- **Warehouse Manager** - Oversight and approvals
- **Warehouse Worker** - Daily operations
- **Picker/Packer** - Order fulfillment
- **Viewer** - Reports only (read-only access)

### What Gets Tracked
- Who received the shipment
- Who recorded product quantities
- Who picked/packed an order
- Who moved inventory between locations

---

## 3. Roles & Permissions

| Role | Permissions |
|------|-------------|
| Admin | Full control, user management |
| Manager | Create products, verify inventory, approve operations |
| Worker | Perform daily operations, stock in/out |
| Viewer | Read-only access |

---

## 4. Product (Item) Management

### Product Attributes
- Name
- SKU / Barcode
- Category
- Unit of measurement (pcs, kg, m, box)
- Supplier
- Min stock level (for alerts)
- Max stock level
- Expiration date (optional, for food/pharma)
- Custom attributes (color, size, etc.)

### Advanced Tracking (Optional)
- Batch Number
- Serial Number
- Manufacturing date
- Expiry date

### Important Distinction
- **Product** = Definition/Master data
- **Inventory** = Product + Location + Quantity

---

## 5. Warehouse & Location System

### Location Hierarchy
```
Warehouse → Zone → Aisle → Rack → Shelf → Bin
```

### Example
```
WH1 → Z01 → A05 → R03 → S01 → B02
```

### API Requirements
- Create warehouses
- Create zones
- Create aisles/racks/shelves
- Create bins
- Link inventory to specific locations

**Benefit:** Workers can find products quickly and accurately.

---

## 6. Inventory Management

### Data Structure
```
inventory: {
   product_id,
   location_id,
   quantity
}
```

### Critical Rules
- ❌ Never update quantity directly
- ✅ All inventory changes must go through transactions
- ✅ Maintain complete audit trail

---

## 7. Transactions (Audit Trail)

### Transaction Types

| Type | Description |
|------|-------------|
| Stock In (Receiving) | Products coming in from supplier |
| Stock Out (Picking) | Products leaving warehouse |
| Stock Move | Internal movement between bins/racks |
| Adjustments | Manager-approved corrections |
| Returns | Returned items back into stock |

### Required Transaction Data
- User ID (who performed it)
- Timestamp
- Before quantity
- After quantity
- Reason (for adjustments)
- Location(s) involved

---

## 8. Receiving Process (Inbound)

### Workflow Steps
1. Create Purchase Order (optional)
2. Supplier delivers goods
3. Worker scans barcodes and inputs quantities
4. Goods are placed into designated bins
5. System records inventory transactions

### Optional Features
- Putaway tasks (assign specific bin to worker)
- Quality check status (PASS/FAIL)
- Discrepancy reporting

---

## 9. Picking Process (Outbound)

### Workflow Steps
1. Customer order arrives
2. System creates picking list
3. Worker picks items from bins
4. System decreases inventory
5. Package prepared for shipment

### Advanced Features
- **Picking Strategies:** FIFO, FEFO, LIFO
- **Multi-order picking:** Batch multiple orders
- **Packing station:** Dedicated packing area
- **Verification:** Scan confirmation

---

## 10. Internal Movement

### Movement Process
```
Move task assigned → Worker executes → System logs movement
```

### Example
```
From: Bin A2
To: Bin D5
Quantity: 15 pcs
Reason: Reorganization
```

**Note:** This is logged as a transaction for full traceability.

---

## 11. Reporting

### Essential Reports
- **Stock Levels** - Current inventory by product
- **Inventory by Location** - What's in each bin/rack
- **Daily Inbound/Outbound** - Daily activity summary
- **Adjustment Report** - All manual corrections
- **Expiring Soon** - Products near expiration
- **Slow-Moving Items** - Low turnover products
- **Fast-Moving Items** - High turnover products
- **User Activity** - Actions by employee
- **Accuracy Metrics** - Picking/receiving accuracy

---

## Summary

A professional WMS is built on:
1. **Users & Permissions** - Track who does what
2. **Products** - Master data definitions
3. **Locations** - Hierarchical warehouse structure
4. **Inventory** - Product + Location + Quantity
5. **Transactions** - Complete audit trail
6. **Processes** - Receiving, Picking, Movement
7. **Reporting** - Visibility and analytics

Every quantity change must be traceable, auditable, and linked to a user and timestamp.
---
Domain Model Concept
---

```mermaid
erDiagram
    Material }|--|| MaterialAmount : besitzt
    ContributionPointsEntry }|--|| MaterialAmount : besitzt


    MaterialAmount{
        String persistence_object_identifier
        Int materialAmount
        String materialIdentifier
        String contributionPointsEntryIdentifier
    }

    Material{
        String persistence_object_identifier
        String itemName
        Int contributionPointsValue
        Int amount
    }

    ContributionPointsEntry{
        String persistence_object_identifier
        String accountName
        String comment
        DateTime createdAt
        DateTime updatedAt
        Int totalContributionpoints
        Int totalAmount
    }

```

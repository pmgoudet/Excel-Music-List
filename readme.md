# 🎵 Music Scanner + Export Excel (PHP)

## 📌 Objectif

Ce projet est un exercice personnel réalisé par curiosité et dans le but d'approfondir mes compétences en PHP. L'objectif est de pratiquer la récursivité, la manipulation de fichiers, le traitement de données et la génération de fichiers Excel à travers un cas concret.

---

## 🚀 Fonctionnalités

- Exploration récursive des dossiers
- Détection des fichiers `.mp3`
- Séparation des musiques valides et ignorées
- Suppression des doublons
- Export vers Excel avec :
  - Onglet "Musiques OK"
  - Onglet "Ignorées"
- Mise en forme du fichier Excel :
  - En-têtes stylés
  - Bordures des cellules
  - Ajustement automatique des colonnes

---

## 📦 Technologies

- PHP 8+
- PhpSpreadsheet

---

## 📁 Format attendu des fichiers

Exemple de nom valide :

Artiste - Nom de la musique.mp3

Les fichiers qui ne respectent pas ce format sont placés dans l’onglet "Ignorées".

---

## ⚙️ Utilisation

1. Installer les dépendances :
composer install

2. Configurer le chemin des musiques :
$path = "D:/Musique";

3. Exécuter le script :
php export.php

---

## 📊 Résultat

Un fichier est généré :

Minhas-musicas.xlsx

Avec deux onglets :
- Musiques OK
- Ignorées

---

## 🧠 Concepts utilisés

- Récursivité
- Manipulation de tableaux PHP
- Passage par référence (&)
- Traitement de chaînes de caractères
- Génération de fichiers Excel

---

## 👨‍💻 Auteur

Projet réalisé dans un objectif d’apprentissage PHP et manipulation de fichiers.

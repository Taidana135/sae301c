<?php

namespace controllers;

class Panier
{
    public function index()
    {
        require_once __DIR__ . '/../models/catalogue.php';
        $catalogue = (new \models\catalogue())->getProduits();
        require 'views/panier/index.php';
    }

    public function ajouter()
    {
        session_start();

        $id = $_POST['id'] ?? null;
        $quantite = $_POST['quantite'] ?? 1;

        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = [];
        }

        if (isset($_SESSION['panier'][$id])) {
            $_SESSION['panier'][$id] += $quantite;
        } else {
            $_SESSION['panier'][$id] = $quantite;
        }

        echo json_encode(['success' => true]);
    }

    public function supprimer()
    {
        session_start();
        $id = $_POST['id'] ?? null;

        if (isset($_SESSION['panier'][$id])) {
            unset($_SESSION['panier'][$id]);
        }

        header('Location: /panier');
    }

    public function vider()
    {
        session_start();
        unset($_SESSION['panier']);
        header('Location: /panier');
    }

    public function valider()
    {
        session_start();

        if (!isset($_SESSION['panier']) || empty($_SESSION['panier'])) {
            echo "<script>alert('Votre panier est vide.'); window.location.href='/panier';</script>";
            return;
        }

        $_SESSION['reservation'] = $_SESSION['panier'];
        unset($_SESSION['panier']);

        echo "<script>alert('Vos articles ont bien été réservés !'); window.location.href='/panier';</script>";
    }
}

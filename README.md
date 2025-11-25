# Mini Proyecto 1 — PHP 🧮

> Resolución de **10 problemas** en **orden** (1→10), con validaciones robustas, UI clara y **sin tocar tu fondo ni tus imágenes**.

<p align="left">
  <img alt="PHP" src="https://img.shields.io/badge/PHP-8%2B-777bb3?logo=php&logoColor=white">
  <img alt="Estado" src="https://img.shields.io/badge/estado-listo-brightgreen">
  <img alt="Licencia" src="https://img.shields.io/badge/licencia-MIT-blue">
</p>

## ⚡ TL;DR
- Abre `index.php` y usa el menú para acceder a **p01..p10**.  
- **Imágenes**: se corrigieron rutas relativas para que se vean desde `solves/`.  
- **Validaciones**: entradas numéricas tolerantes (`12,5` o `12.5`), rangos por problema y mensajes claros.

---

## 📚 Tabla de contenidos
- [Descripción](#-descripción)
- [Stack](#-stack)
- [Estructura](#-estructura)
- [Instalación](#-instalación)
- [Ejecución local](#-ejecución-local)
- [Uso (Problemas 1→10)](#-uso-problemas-110)
- [Validaciones y errores](#-validaciones-y-errores)
- [UI/Accesibilidad](#-uiaccesibilidad)
- [Checklist de evaluación](#-checklist-de-evaluación)
- [Solución de problemas (imágenes)](#-solución-de-problemas-imágenes)
- [Git (subir a GitHub)](#-git-subir-a-github)
- [Contribución](#-contribución)
- [Autores](#-autores)
- [Licencia](#-licencia)

---

## 🧭 Descripción
Mini proyecto web en PHP que resuelve **10 problemas** con:
- Menú principal.
- Formulario y salida por problema.
- **Validaciones** estrictas pero amigables.
- **Imágenes y fondo originales** conservados; solo se ajustaron **rutas relativas** para que se muestren bien desde `solves/`.

---

## 🧰 Stack
- **PHP 8+**
- **HTML + CSS** (hojas propias del proyecto)
- (Opcional) **Bootstrap/Chart.js** si ya estaban en el proyecto

---

## 🗂 Estructura
```
mini proyecto 1/
├─ index.php
├─ bootstrap.php
├─ app/
│  └─ Utils/
│     ├─ Validator.php     # validaciones numéricas (., ,) y helpers
│     └─ Math.php          # utilidades de cálculo
├─ public/
│  ├─ assets/              # imágenes, íconos, banners
│  └─ css/styles.css       # estilos del sitio
└─ solves/
   ├─ p01.php ... p10.php  # páginas de cada problema (orden 1→10)
```

---

## 🛠 Instalación
Clona el repo:
```bash
git clone https://github.com/eleazarrrg/mini-proyecto-1.git
cd mini-proyecto-1/"mini proyecto 1"
```

> Si trabajas con **XAMPP/Laragon**, copia la carpeta `mini proyecto 1/` a tu `htdocs` (o `www`).

---

## ▶️ Ejecución local
**Opción A: servidor embebido de PHP**
```bash
php -S localhost:8000 -t "./mini proyecto 1"
# Abre http://localhost:8000/index.php
```

**Opción B: XAMPP/Laragon**
- `http://localhost/mini%20proyecto%201/index.php`

---

## 🧪 Uso (Problemas 1→10)
1. **P01** — Ingresa **5 números** → media, desviación, mínimo y máximo.  
2. **P02** — Suma **1..1000** (fórmula n(n+1)/2).  
3. **P03** — **N** múltiplos de 4 (con límites razonables).  
4. **P04** — Suma de **pares** e **impares** en 1..200.  
5. **P05** — **5 edades** → categorías (Niño, Adolescente, Adulto, Adulto mayor).  
6. **P06** — Presupuesto hospital (**40/35/25**).  
7. **P07** — **K** notas → estadísticas (media, σ, min, max).  
8. **P08** — Estación del año por **fecha** *(hemisferio sur; p. ej. 25-09 → Primavera)*.  
9. **P09** — **15 primeras potencias** de un número (1..9).  
10. **P10** — Matriz **ventas 5×4** → totales por fila/columna y total global.

---

## 🧯 Validaciones y errores
- `Validator::isNumeric()` acepta **coma o punto** (`12,5` / `12.5`) y espacios.
- `Validator::toFloat()` normaliza separadores y convierte a `float` (tolera `1_000`).
- **Rangos** por problema:
  - Presupuesto/ventas/notas: **no negativos**.
  - P03 (N múltiplos): límite superior razonable para no colgar la página.
  - P09: número en **1..9**.
- Mensajes de error claros junto al formulario cuando algo no es válido.

---

## 🎨 UI/Accesibilidad
- **Fondo e imágenes originales**: intactos.  
- Reglas **no invasivas** para que las imágenes no se desborden en pantallas pequeñas (mantienen proporción).  
- Botones con **foco visible** y `cursor: pointer` para mejorar la usabilidad.

---

## ✅ Checklist de evaluación
- [x] **10 problemas** en el **orden correcto** (1→10).  
- [x] Cálculos correctos (media, σ, min, max; sumas; potencias; totales matriz).  
- [x] **Validaciones** de entrada (coma/punto, rangos, no negativos donde aplica).  
- [x] **Imágenes** y **fondo** respetados; **rutas** corregidas para `solves/`.  
- [x] Mensajes de error y formularios claros.  
- [x] Código organizado: `Utils/Validator.php`, `Utils/Math.php`, `solves/pXX.php`.

---

## 🧩 Solución de problemas (imágenes)
- Desde `solves/`, toda imagen debe referenciarse **relativamente**:
  ```html
  <!-- Correcto dentro de solves/*.php -->
  <img src="../public/assets/banner-stats.png" alt="Banner">
  ```
- Si no carga, revisa en DevTools (Network) que el PNG/JPG devuelva **200** y ajusta la ruta.

---

## 🧷 Git (subir a GitHub)
```bash
# dentro de: mini-proyecto-1/"mini proyecto 1"
git init
git add .
git commit -m "chore: proyecto base (mini proyecto 1) + fixes de rutas de imágenes y validador"
git branch -M main
git remote add origin https://github.com/eleazarrrg/mini-proyecto-1.git
# o con SSH: git remote add origin git@github.com:eleazarrrg/mini-proyecto-1.git
git push -u origin main
```

`.gitignore` recomendado:
```gitignore
# SO / IDE
.DS_Store
Thumbs.db
.vscode/
.idea/
*.log

# PHP/Servidor
vendor/
.env
.env.*
composer.lock

# Front
node_modules/
dist/

# Archivos grandes/temporales
*.zip
*.rar
*.7z
*.tar
*.tar.gz

# Cache
.cache/
*.cache
```

---

## 🤝 Contribución
1. Crea una rama: `git checkout -b feat/mi-mejora`  
2. Commit: `git commit -m "feat: mejora X"`  
3. Push: `git push origin feat/mi-mejora`  
4. Abre un Pull Request.

---

## 👥 Autores
**Alex DeBoutaud** y **Rafael Gomez**  
Repo: <https://github.com/eleazarrrg/mini-proyecto-1>

---

## 📄 Licencia
**MIT** — Usa y adapta citando a los autores.

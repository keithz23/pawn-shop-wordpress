document.addEventListener("DOMContentLoaded", function () {
  // Category tabs functionality
  const categoryContent = {
    企業融資: {
      title: "企業融資方案",
      description: "為公司行號提供靈活融資方案，協助成長、解決資金需求",
      features: [
        "備妥企業及負責人相關文件",
        "審核借款額度及利率",
        "說明計息方式及合作模式",
        "火速提供資金提供協助",
      ],
      image: themeData.templateUrl + "/assets/4cropped.jpeg",
    },
    不動產貸款: {
      title: "不動產貸款方案",
      description: "房屋土地等不動產借款，合法利率、手續簡便",
      features: [
        "土地、房屋、廠房等不動產借款",
        "銀行設定、民間設定皆可",
        "利率優惠、手續簡便",
        "撥款快速、過件率高",
      ],
      image: themeData.templateUrl + "/assets/9cropped.jpg",
    },
    個人信貸: {
      title: "個人信貸方案",
      description: "提供個人信用貸款，快速審核、利率透明",
      features: [
        "簡易審核、快速撥款",
        "利率透明、無隱藏費用",
        "靈活還款方式",
        "專業諮詢服務",
      ],
      image: themeData.templateUrl + "/assets/1cropped.jpeg",
    },
    汽機車借款: {
      title: "汽機車借款方案",
      description: "汽機車分期、借款服務，手續簡便、即刻撥款",
      features: [
        "汽機車分期借款",
        "免留車方案",
        "即日審核撥款",
        "利率優惠透明",
      ],
      image: themeData.templateUrl + "/assets/10cropped.jpeg",
    },
    代償高利: {
      title: "代償高利方案",
      description: "協助代償高利債務，降低利息負擔",
      features: [
        "代償高利債務",
        "降低每月還款金額",
        "整合各項貸款",
        "專業債務規劃",
      ],
      image: themeData.templateUrl + "/assets/5cropped.jpeg",
    },
    債務協商: {
      title: "債務協商方案",
      description: "專業債務協商服務，協助您解決債務問題",
      features: [
        "債務問題諮詢",
        "協商還款方案",
        "降低利息負擔",
        "法律諮詢服務",
      ],
      image: themeData.templateUrl + "/assets/2cropped.png",
    },
    商販週轉: {
      title: "商販週轉方案",
      description: "為商家提供營運週轉金，協助業務發展",
      features: [
        "商業營運週轉",
        "彈性還款方案",
        "快速審核撥款",
        "無需複雜手續",
      ],
      image: themeData.templateUrl + "/assets/3cropped.jpeg",
    },
    "小額借貸&支票週轉": {
      title: "小額借貸及支票週轉",
      description: "提供小額借貸和支票週轉服務，解決短期資金需求",
      features: [
        "小額借貸服務",
        "支票週轉借款",
        "快速審核撥款",
        "靈活還款方案",
      ],
      image: themeData.templateUrl + "/assets/6cropped.jpeg",
    },
  };

  function updateCategoryContent(category) {
    const contentDiv = document.querySelector(".category-content");
    const categoryData = categoryContent[category];

    if (!contentDiv) {
      return;
    }

    if (categoryData) {
      contentDiv.innerHTML = `
                <div class="category-panel active">
                    <div class="category-details">
                        <div class="category-info">
                            <h3>${categoryData.title}</h3>
                            <p>${categoryData.description}</p>
                            <ul class="feature-list">
                                ${categoryData.features
                                  .map(
                                    (feature) =>
                                      `<li><i class="fas fa-check"></i> ${feature}</li>`
                                  )
                                  .join("")}
                            </ul>
                            <div class="category-cta">
                                <a href="https://line.me/ti/p/@599jmyld" target="_blank" class="contact-button line-button" style="color: green">
                                    <i class="fab fa-line" style="color: green"></i>
                                    立即LINE諮詢
                                </a>
                            </div>
                        </div>
                        <div class="category-image">
                            <img src="${categoryData.image}" alt="${
        categoryData.title
      }">
                        </div>
                    </div>
                </div>
            `;
    }
  }

  // Add click event listeners to category tabs
  const categoryTabs = document.querySelectorAll(".category-tab");
  categoryTabs.forEach((tab) => {
    tab.addEventListener("click", function () {
      // Remove active class from all tabs
      categoryTabs.forEach((t) => t.classList.remove("active"));
      // Add active class to clicked tab
      this.classList.add("active");
      // Update content
      updateCategoryContent(this.dataset.category);
    });
  });

  // Initialize with first category
  document.addEventListener("DOMContentLoaded", function () {
    const contentDiv = document.querySelector(".category-content");
    if (contentDiv) {
      updateCategoryContent("企業融資");
    } else {
      console.error(
        "Error: .category-content element not found in the DOM during initialization."
      );
    }
  });

  // Mobile menu toggle
  const menuToggle = document.querySelector(".menu-toggle");
  const navLinks = document.querySelector(".nav-links");

  if (menuToggle && navLinks) {
    menuToggle.addEventListener("click", function () {
      navLinks.classList.toggle("active");
      menuToggle.classList.toggle("active");
    });
  }
});

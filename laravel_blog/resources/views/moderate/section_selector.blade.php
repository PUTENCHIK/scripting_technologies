<div class="section-selector">
    <div
        @click="sectionComments"
        :class="isCommentsSection ? 'variant chosen' : 'variant'"
    >
        Комментарии
    </div>

    <div class="line"></div>

    <div
        @click="sectionStatuses"
        :class="!isCommentsSection ? 'variant chosen' : 'variant'"
    >
        Статусы
    </div>
</div>

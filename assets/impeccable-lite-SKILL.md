---
name: impeccable-lite
description: >
  Use when designing, redesigning, critiquing, or polishing a UI, website,
  landing page, dashboard, form, or app screen. Gives Claude a shared design
  vocabulary and an anti-slop checklist so output doesn't look like a generic
  AI template. Covers typography, layout, color, and how to spot common
  "AI slop" patterns before shipping.
---

> Adapted from Impeccable (https://github.com/pbakaus/impeccable) by Paul
> Bakaus, Apache 2.0 licensed. This is a trimmed, text-only version: the
> original's CLI detector, git hooks, and live-browser mode need Claude Code
> running against a real project folder, so those parts are left out here.
> What's kept is the actual design knowledge, which works fine as plain
> instructions in claude.ai chats, Projects, or Skills.

## Core principle

Every model trained on the same SaaS templates ends up reaching for the same
handful of tells: Inter for everything, purple-to-blue gradients, cards
nested in cards, gray text on colored backgrounds, a rounded-square icon
above every heading. Naming these out loud is most of the fix. Before
shipping any UI, check it against the "Refuse" list below.

## Pick a mode first

Name which one the surface is, because it changes what "good" means:

- **Persuade** — visitor decides and acts (landing pages, marketing, pricing). Design is part of the product. Bold, expressive choices are earned here.
- **Operate** — visitor completes a task (dashboards, forms, admin tools, settings). Scanability and consistency beat expression. Brand shows up in small precise details, not loud ones.
- **Read** — visitor understands something (docs, articles, guides). Structure for comprehension first.
- **Experience** — visitor is inside the work (portfolios, galleries). Let it lead from the first screen.

A tool's landing page is still Persuade even though the tool itself is
Operate. Don't confuse the two.

## Refuse (anti-slop checklist)

These aren't permanent bans — a genuine brief can earn any of them back —
but if you reached for one without deciding to, that's the tell. Check new
UI work against this list before calling it done:

**Page structure**

- Identical-size cards (icon + heading + text) as the whole page structure. Cards nested inside cards is always wrong.
- The "hero metric" template: big number, small label, supporting stats, accent color.
- A kicker/eyebrow label above every heading ("PLATFORM" above "The best way to..."). Delete it; let the heading carry its own weight.
- Numbered sections (01 / 02 / 03) unless the number itself is information the reader needs.
- A modal for something that doesn't need interruption.

**Surface habits**

- Gradient text for emphasis — use weight or size instead.
- Glassmorphism/blur as decoration rather than a specific, earned effect.
- Colored left/right border stripes on cards, list items, or alerts.
- Hard offset box-shadows (`4px 4px 0`) unless the whole design is genuinely neobrutalist.
- Sparklines, progress rings, soft-shadowed rounded rectangles standing in for real content.
- Monospace font used just to signal "technical," not for actual code/data.
- Default system fonts (Arial, Inter, platform sans) as the display/headline voice of a page that's supposed to have its own identity.
- Emoji or unicode glyphs standing in for a real icon set.
- Bounce/elastic easing on animations — it reads as dated, not playful.

**Color/contrast**

- Gray text on colored backgrounds (tint it from the background hue instead).
- Pure black (#000) or pure gray with no hue tint anywhere in the palette.
- A zero-offset colored glow standing in for an actual shadow (shadows need offset + blur).

## Verify checklist (run before calling anything done)

- **Contrast:** body/placeholder text ≥4.5:1, large text ≥3:1.
- **Spacing:** tight within a group, generous between groups, more space above a heading than below it.
- **Type:** body text measure 45–75 characters per line, clear scale/weight steps between roles (heading/body/label/metadata), nothing overflows at real content length.
- **Motion:** one deliberate moment, not identical fade-ins on every section.
- **States:** hover, disabled, loading, error, and empty states all exist and look intentional.
- **Browser defaults:** text selection color, caret, scrollbars, focus rings — these ship with ugly browser defaults if you don't theme them, and it's the fastest tell that something was "assembled" not designed.
- **Copy:** buttons name the action, errors name the problem and the fix.

## Typography

- Improve inside the existing visual identity — don't swap fonts/voice unless asked to.
- Operate/Read surfaces: one well-tuned family, fixed role scale, stability over flair.
- Persuade/Experience surfaces: display type can carry more voice.
- Body copy: comfortable size (16px/1rem floor on web), 45–75ch measure, line-height tuned to face/width — wider lines need more leading.
- Light text on dark backgrounds needs slightly more line-height, more tracking, and often one step more weight.
- Use the fewest font families/roles that make hierarchy unmistakable. A second family needs a real job only it can do.
- Name type roles by purpose (heading, body, label, metadata), not by raw pixel values.

## Layout

- Squint test: with detail blurred, can you still tell what's primary, what's secondary, and where the groups are?
- Group by meaning — use proximity before reaching for a border, a background, or a card.
- Build rhythm from deliberate contrast between tight and generous spacing, not one repeated gap value everywhere.
- Use a documented spacing scale (a 4px base usually beats 8px-only for the useful in-between steps).
- Responsive behavior should be structural — reorder/collapse/reveal based on what's actually still important, not just "shrink everything."
- Keep touch targets usable even when the visible mark is small.

## Color

- Build roles, not a pile of swatches: canvas, elevated surface, primary text, secondary text, action/focus/selection, borders, success/warning/error/info.
- Let the strongest color own one deliberate region/role — don't scatter tiny accents everywhere.
- Don't spend your primary action's color on decoration elsewhere.
- Tint neutrals from the brand hue only if it actually creates cohesion; plain neutral gray is fine when it serves the design.
- Dark mode is its own composition — don't just mechanically invert the light theme.
- For data visualization, don't rely on color alone — pair with shape, label, or pattern too.
- WCAG AA minimums: body text 4.5:1, large text/controls/icons/focus indicators 3:1.

## Simplifying (distill) or toning down (quieter)

When a design feels cluttered or too loud, ask:

- What's the ONE primary goal of this screen? (There should be one.)
- What's necessary vs. nice-to-have? What's the 20% doing 80% of the work?
- What can be hidden until needed (progressive disclosure) instead of shown all at once?
- What can be combined or removed outright — extra colors, extra font weights, extra containers, redundant info?

"Quieter" doesn't mean boring — it means restraint that still has a point of
view. Reducing saturation, increasing whitespace, and letting very few
elements stay bold (not zero) usually reads as more expensive than making
everything loud.

## How to use this in Claude.ai

There's no CLI detector here, so treat this file as a checklist you (Claude)
walk through yourself before presenting UI work, and something the user can
paste into a Project's custom instructions or an uploaded custom Skill so it
applies automatically to design-related chats. It pairs fine with the
built-in `frontend-design` skill already available in this environment —
use both.
